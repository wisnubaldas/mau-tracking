<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusTracking;
class StatusTrackingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'stat'=>'Acceptance confirmation (before security screening)',
                'code'=>'A1',
                'desc'=>'Regulated Agent'
            ],
            [
                'stat'=>'Security Screening Process',
                'code'=>'A2',
                'desc'=>'Regulated Agent'
            ],
            [
                'stat'=>'Digital Weighing Scale',
                'code'=>'A3',
                'desc'=>'Regulated Agent'
            ],
            [
                'stat'=>'Updated Rejected Item',
                'code'=>'A4',
                'desc'=>'Regulated Agent'
            ],
            [
                'stat'=>'RA Storage Position',
                'code'=>'A5',
                'desc'=>'Regulated Agent'
            ],
            [
                'stat'=>'Consignment Security Declaration (CSD) issuance',
                'code'=>'A6',
                'desc'=>'Regulated Agent'
            ],
            [
                'stat'=>'Loading process to vehicle',
                'code'=>'A7',
                'desc'=>'Regulated Agent'
            ],
            [
                'stat'=>'Transportation to warehouse lini-1',
                'code'=>'A8',
                'desc'=>'Regulated Agent'
            ],
            [
                'stat'=>'Hand-over to Airline',
                'code'=>'A9',
                'desc'=>'Regulated Agent'
            ],
            [
                'stat'=>'Delivery from aircraft to incoming warehouse',
                'code'=>'B1',
                'desc'=>'Inbound'
            ],
            [
                'stat'=>'Arrival at Incoming warehouse',
                'code'=>'B2',
                'desc'=>'Inbound'
            ],
            [
                'stat'=>'Storage',
                'code'=>'B3',
                'desc'=>'Inbound'
            ],
            [
                'stat'=>'Custom & quarantine Clearance',
                'code'=>'B4',
                'desc'=>'Inbound'
            ],
            [
                'stat'=>'Received by consignee',
                'code'=>'B5',
                'desc'=>'Inbound'
            ],
            [
                'stat'=>'Delivery from aircraft to incoming warehouse',
                'code'=>'C1',
                'desc'=>'Transit/Transfer',
            ],
            [
                'stat'=>'Arrival at Incoming warehouse',
                'code'=>'C2',
                'desc'=>'Transit/Transfer',
            ],
            [
                'stat'=>'Storage',
                'code'=>'C3',
                'desc'=>'Transit/Transfer',
            ],
            [
                'stat'=>'Manifesting',
                'code'=>'C4',
                'desc'=>'Transit/Transfer',
            ],
            [
                'stat'=>'Build Up process',
                'code'=>'C5',
                'desc'=>'Transit/Transfer',
            ],
            [
                'stat'=>'Delivery to Staging Area',
                'code'=>'C6',
                'desc'=>'Transit/Transfer',
            ],
            [
                'stat'=>'Delivery to Aircarft',
                'code'=>'C7',
                'desc'=>'Transit/Transfer',
            ],
            [
                'stat'=>'Loading to Aircraft',
                'code'=>'C8',
                'desc'=>'Transit/Transfer',
            ],
            [
                'stat'=>'Acceptance confirmation',
                'code'=>'D1',
                'desc'=>'Outbound'
            ],
            [
                'stat'=>'Weighing Scale',
                'code'=>'D2',
                'desc'=>'Outbound'
            ],
            [
                'stat'=>'Manifesting',
                'code'=>'D3',
                'desc'=>'Outbound'
            ],
            [
                'stat'=>'Storage Position',
                'code'=>'D4',
                'desc'=>'Outbound'
            ],
            [
                'stat'=>'Build Up process',
                'code'=>'D5',
                'desc'=>'Outbound'
            ],
            [
                'stat'=>'Delivery to Staging Area',
                'code'=>'D6',
                'desc'=>'Outbound'
            ],
            [
                'stat'=>'Delivery to Aircraft',
                'code'=>'D7',
                'desc'=>'Outbound'
            ],
            [
                'stat'=>'Loading to Aircraft',
                'code'=>'D8',
                'desc'=>'Outbound'
            ],
        ];
        StatusTracking::insert($data);
    }
}
