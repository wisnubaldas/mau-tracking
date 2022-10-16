<?php 
namespace App\Domain;

interface SearchFactoryInterface{
    public const C_AIRCARFT = 'c_td_inbound_delivery_aircarft';
    public const L_AIRCARFT = 'l_td_inbound_delivery_aircarft';
    public function get_aircarft_count():void;
}