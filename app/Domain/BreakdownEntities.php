<?php
namespace App\Domain;
use App\Domain\BreakdownInterface;

class BreakdownEntities implements BreakdownInterface{
    public $data_breakdown;
    public const TPS = 'MAU1';
    public const GATE = 'import';
    public const WAREHOUSE = 'BDO';
    public function set_data_breakdown($data): void
    {
        $this->data_breakdown = $data;
    }
}