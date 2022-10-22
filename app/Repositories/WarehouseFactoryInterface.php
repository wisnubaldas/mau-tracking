<?php
namespace App\Repositories;
interface WarehouseFactoryInterface {
    public function count_data($model);
    public function get_master($model,$limit);
    public function get_breakdown($model,$limit);
    public function get_breakdown_detail($model,$limit);
    public function get_deliorder($model,$limit);
    public function get_pod($model,$limit);
}