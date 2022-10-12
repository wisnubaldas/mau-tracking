<?php
namespace App\Repositories;
use App\Domain\InboundEntities;

use App\Models\Tps\Inbound;
use App\Models\Warehouse\ImpBreakdownheader;

class InboundInputPort implements InboundInterface {
    public function count()
    {
        return ImpBreakdownheader::count();
    }
    // public $limit;
    // public function all_inbound(Inbound $inbound)
    // {
    //     return $inbound->first();
    // }
    // public function all_detail($param,...$field)
    // {
    //     return $this->detail->select($field)->whereIn('nomor_aju',$param);
    // }
    // public function all_master(...$data)
    // {
    //     return $this->manifest->select($data)
    //                 ->orderBy('tgl_tiba')
    //                 ->limit($this->limit);
    // }
    // public function manifest_detail()
    // {
    //     return $this->all_detail(
    //                         $this->manifest_header()
    //                             ->pluck('nomor_aju'),
    //                                     'nomor_aju',
    //                                     'no_master_blawb',
    //                                     'no_host_blawb',
    //                                     'nama_shipper',
    //                                     'almt_shipper',
    //                                     'nama_notify'
    //                             )->get();
    // }
    // public function manifest_header()
    // {
    //     return $this->all_master('nomor_aju','nm_sarana_angkut','no_imo');
    // }
    // public function inbound_data()
    // {
    //     // $this->all_inbound();
    //     $counter = $this->manifest->count();
    //     $file = new CounterHandler('inbound',$counter);
    //     if($counter > $file->get()){

    //         $this->limit = ($counter - $file->get());
    //         $this->manifest_header();
    //         $this->manifest_detail();
    //     };
    //     // $file->save();
    // }
    
}