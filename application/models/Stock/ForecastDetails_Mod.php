<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ForecastDetails_Mod extends CI_Model {

        function __construct() {
                parent::__construct();
        }

        function get_user_forecast_details( $user_id ) {
                $this -> db -> select( "sip.stock_period_id, sip.stock_id, s.name as stock_name, s.code as stock_code, COALESCE(sf.weekly_forecast,0) as weekly_forecast, "
                        . "COALESCE(sf.monthly_forecast,0) as monthly_forecast, COALESCE(sf.yearly_forecast,0) as yearly_forecast, COALESCE(sf.stock_rating,0) as stock_rating,"
                        . "sp.is_weekly_stop,sp.is_monthly_stop,sp.is_yearly_stop" );
                $this -> db -> from( "stock_into_period sip" );
                $this -> db -> join( "stock_period sp ", "sp.id = sip.stock_period_id", "INNER" );
                $this -> db -> join( "stocks s", "s.id = sip.stock_id", "INNER" );
                $this -> db -> join( "stock_forecasting sf", "sf.stock_period_id = sip.stock_period_id AND sf.stock_id = sip.stock_id AND sf.user_id = '$user_id'", "LEFT" );
                $this -> db -> where( "sip.stock_period_id = '1' AND sp.is_active = '1'" );
                $user_forecast = $this -> db -> get() -> result_array();
                return $user_forecast;
        }

        function update_user_forecast( $inputs ) {
                $user_id = $inputs[ 'user_id' ];

                $stock_period_id = $inputs[ 'stock_period_id' ];

                //these are array for stock ids, weekely, monthly and yearly stock forecast
                $stocks = $inputs[ 'stock_id' ];
                $most_rated = $inputs[ 'most_rated' ];
                $weekly_forecast = $inputs[ 'stock_weekly_forecast' ];
                $monthly_forecast = $inputs[ 'stock_monthly_forecast' ];
                $yearly_forecast = $inputs[ 'stock_yearly_forecast' ];

                /* update game played by user */
                $update_user_game_played = array (
                    "is_game_played" => "1"
                );
                $this -> db -> where( "id = $user_id" );
                $this -> db -> cache_delete_all();
                $this -> db -> update( "users", $update_user_game_played );
                /* update game played by user */

                $this -> db -> select( "1" );
                $this -> db -> from( "stock_forecasting" );
                $this -> db -> where( "user_id = '$user_id' AND stock_period_id = '$stock_period_id'" );
                $is_already_forecast = $this -> db -> get() -> num_rows();

                /* Add Update SEAT forecast */
                if ( $is_already_forecast == 0 ) {
                        foreach ( $stocks as $key => $stock_id ) {
                                $insert_forecast[] = array (
                                    "user_id" => $user_id,
                                    "stock_period_id" => $stock_period_id,
                                    "stock_id" => $stock_id,
                                    "weekly_forecast" => $weekly_forecast[ $key ],
                                    "monthly_forecast" => $monthly_forecast[ $key ],
                                    "yearly_forecast" => $yearly_forecast[ $key ],
                                    "stock_rating" => $most_rated[ $key ]
                                );

                                //update forecast rating of stocks - increasing rating by 1 on every insert
                                $update_most_rating = $most_rated[ $key ];
                                $this -> db -> where( "stock_period_id = '$stock_period_id' AND stock_id = '$stock_id'" );
                                $this -> db -> set( "stock_rating", "stock_rating+$update_most_rating", FALSE );
                                $this -> db -> update( "stock_into_period" );
                        }
                        $this -> db -> insert_batch( 'stock_forecasting', $insert_forecast );

                        //update rating against the stocks
                        $this -> updateUniqueStockRating( $stock_period_id );

                        echo json_encode( array ( "status" => TRUE, "message" => "Data saved successfully." ) );
                        return true;
                } else {
                        foreach ( $stocks as $key => $stock_id ) {
                                //update forecast rating of stocks - increasing rating by 1 on every update
                                //$update_most_rating = $most_rated[$key];
                                //$this->db->where("stock_period_id = '$stock_period_id' AND stock_id = '$stock_id'");
                                //$this->db->set("stock_rating", "stock_rating+$update_most_rating", FALSE);
                                //$this->db->update("stock_into_period");
                                /*                                 * ************************** */
                                //update users latest forecast of stocks
                                $update_forecast = array (
                                    "weekly_forecast" => $weekly_forecast[ $key ],
                                    "monthly_forecast" => $monthly_forecast[ $key ],
                                    "yearly_forecast" => $yearly_forecast[ $key ],
                                    "stock_rating" => $most_rated[ $key ]
                                );
                                $this -> db -> where( array ( "user_id" => $user_id, "stock_period_id" => $stock_period_id, "stock_id" => $stock_id ) );
                                $this -> db -> update( 'stock_forecasting', $update_forecast );

                                //update rating against the stocks
                                $this -> updateUniqueStockRating( $stock_period_id );
                        }
                        echo json_encode( array ( "status" => TRUE, "message" => "Data saved successfully." ) );
                        return true;
                }
        }

        //unique stock rating
        function updateUniqueStockRating( $stock_period_id ) {
                $this -> db -> select( "sf.stock_period_id, sf.stock_id, SUM(sf.stock_rating) as total_rating" );
                $this -> db -> from( "stock_forecasting sf" );
                $this -> db -> where( "sf.stock_period_id = '$stock_period_id'" );
                $this -> db -> group_by( "sf.stock_id" );
                $result = $this -> db -> get() -> result_array();
                $this -> db -> cache_delete_all();
                foreach ( $result as $updateRating ) {
                        $stock_id = $updateRating[ 'stock_id' ];

                        $update = array (
                            "stock_rating" => $updateRating[ 'total_rating' ]
                        );

                        $this -> db -> where( "stock_period_id = '$stock_period_id' AND stock_id = '$stock_id'" );
                        $this -> db -> update( "stock_into_period", $update );
                }

                return true;
        }

}
