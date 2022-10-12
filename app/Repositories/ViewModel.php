<?php 
namespace App\Repositories;
use App\Models\Tps\ManifestHeader;
use App\Models\Tps\ManifestDetail;

abstract class ViewModel{
    public $manifest;
    public $detail;
    public function __construct($manifest = new ManifestHeader, $detail = new ManifestDetail) {
        $this->manifest = $manifest;
        $this->detail = $detail;
    }
    abstract public function all_master(...$field);
    abstract public function all_detail($param, ...$field);
}