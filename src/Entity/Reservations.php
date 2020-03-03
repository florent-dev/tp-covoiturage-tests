<?php

namespace App\Entity;

class Reservations
{
    public function distance($lat1, $lng1, $lat2, $lng2) {
        $x = deg2rad($lng1 - $lng2) * ( cos( deg2rad($lat1+$lat2) ) /2 );
        $y = deg2rad( $lat1 - $lat2 );
        $dist = 6371000.0 * sqrt($x*$x + $y+$y);

        return $dist;
    }

    public function distanceDepart($user, $trajet) {
        list($latuser, $lnguser) = $user->current_coordinates();

        $depart = $trajet->getDepart();

        $distance = $this->distance($latuser, $lnguser, $depart->getLatitude(), $depart->getLongitude());

        return $distance;
    }

    public function passagerReservation($user, $trajet) {
        // some stuffs...
        //
        $user->addReservationTrajet($trajet);
    }
}
