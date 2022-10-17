<?php 
namespace App\Domain;

interface SearchFactoryInterface{
    public const C_AIRCARFT = 'c_td_inbound_delivery_aircarft';
    public const L_AIRCARFT = 'l_td_inbound_delivery_aircarft';

    public const C_BREAKDOWN = 'c_td_inbound_breakdown';
    public const L_BREAKDOWN = 'l_td_inbound_breakdown';

    public const C_STORAGE = 'c_td_inbound_storage';
    public const L_STORAGE = 'l_td_inbound_storage';

    public const C_CLEARANCE = 'c_td_inbound_clearance';
    public const L_CLEARANCE = 'l_td_inbound_clearance';

    public const C_POD = 'c_td_inbound_pod';
    public const L_POD = 'l_td_inbound_pod';

    public function count_data($model):void;
    public function set_file_counter($counter,$limit):void;
    public function set_tracking($input_method):void;

}