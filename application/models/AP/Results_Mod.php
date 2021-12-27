<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Results_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_avg_seat_vote_forecast( $election_period_id, $state_id ) {
        /* Get AVG SEAT Forecasts */
        $array_of_ordered_ids = array ( 14, 21, 41, 1, 2, 18 );
        $order = sprintf( 'FIELD(p.id, %s)', implode( ', ', $array_of_ordered_ids ) );

        $this -> db -> select( "uf.id,uf.election_period_id,uf.state_id,uf.party_id,AVG(uf.seat_forecast) as avg_seatforecast,p.name as party_name, p.bilingual_name, p.local_lang, p.abbreviation, p.icon" );
        $this -> db -> from( "user_forecasting uf" );
        $this -> db -> join( "parties p", "uf.party_id = p.id", "INNER" );
        $this -> db -> where( "election_period_id = '$election_period_id' AND state_id = '$state_id' AND user_id not in (select user_id from user_forecasting WHERE election_period_id = '$election_period_id' and state_id = '$state_id' group by user_id having sum(seat_forecast) = 0)" );
        $this -> db -> group_by( "party_id" );
        //$this->db->order_by("uf.id");
        $this -> db -> order_by( $order );
        $avg_forecasting[ 'avg_seatforecast' ] = $this -> db -> get() -> result_array();

        /* Get AVG VOTE Forecasts */
        $this -> db -> select( "uf.id,uf.election_period_id,uf.state_id,uf.party_id,AVG(uf.vote_forcast) as avg_voteforcast,p.name as party_name, p.local_lang, p.abbreviation, p.icon" );
        $this -> db -> from( "user_forecasting uf" );
        $this -> db -> join( "parties p", "uf.party_id = p.id", "INNER" );
        $this -> db -> where( "election_period_id = '$election_period_id' AND state_id = '$state_id' AND user_id not in (select user_id from user_forecasting WHERE election_period_id = '$election_period_id' and state_id = '$state_id' group by user_id having sum(vote_forcast) = 0)" );
        $this -> db -> group_by( "party_id" );
        //$this->db->order_by("uf.id");
        $this -> db -> order_by( $order );
        $avg_forecasting[ 'avg_voteforcast' ] = $this -> db -> get() -> result_array();

        //Get actual result for SEAT and VOTE forecast
        $this -> db -> select( "election_period_id,state_id,party_id,actual_seats,actual_votes" );
        $this -> db -> from( "state_party" );
        $this -> db -> where( "is_active = '1' AND election_period_id = '$election_period_id' AND state_id = '$state_id'" );
        //$this->db->order_by('party_id');
        $this -> db -> order_by( sprintf( 'FIELD(party_id, %s)', implode( ', ', $array_of_ordered_ids ) ) );
        $actual_seat_vote_result = $this -> db -> get() -> result_array();

        $forecast = [];
        foreach ( $avg_forecasting[ 'avg_seatforecast' ] as $key => $forecasting ) {

            $avg_forecasting[ 'avg_seatforecast' ][ $key ][ 'avg_voteforcast' ] = 0;
            if ( isset( $avg_forecasting[ 'avg_voteforcast' ][ $key ] ) ) {
                $avg_forecasting[ 'avg_seatforecast' ][ $key ][ 'avg_voteforcast' ] = $avg_forecasting[ 'avg_voteforcast' ][ $key ][ 'avg_voteforcast' ];
            }

            $avg_forecasting[ 'avg_seatforecast' ][ $key ][ 'actual_seats' ] = $actual_seat_vote_result[ $key ][ 'actual_seats' ];
            $avg_forecasting[ 'avg_seatforecast' ][ $key ][ 'actual_votes' ] = $actual_seat_vote_result[ $key ][ 'actual_votes' ];

            $forecast[] = $avg_forecasting[ 'avg_seatforecast' ][ $key ];
        }

        return $forecast;
    }

    function get_actual_and_users_seat_vote_forecast( $id ) {
        //Get actual result for SEAT and VOTE forecast

        $this -> db -> select( "u.id,u.name,u.rank,u.points,u.certificate_path,s.name as location,p.name as party,p.abbreviation" );
        $this -> db -> from( "users u" );
        $this -> db -> join( "states s", "s.id = u.location", "INNER" );
        $this -> db -> join( "parties p", "p.id = u.party_affiliation", "INNER" );
        $this -> db -> where( "u.id = $id" );
        $user_detail = $this -> db -> get() -> row_array();

        $this -> db -> select( "uf.*,p.name,p.abbreviation,p.icon,sp.actual_seats,sp.actual_votes" );
        $this -> db -> from( "user_forecasting uf" );
        $this -> db -> join( "parties p", "p.id = uf.party_id", "INNER" );
        $this -> db -> join( "state_party sp", "sp.party_id = uf.party_id", "INNER" );
        $this -> db -> where( "user_id = $id" );
        $this -> db -> order_by( 'party_id' );
        $actual_seat_vote_result = $this -> db -> get() -> result_array();

        $data[ 'user_detail' ] = $user_detail;
        $data[ 'actual_and_user_forecast' ] = $actual_seat_vote_result;

        return $data;
    }

}
