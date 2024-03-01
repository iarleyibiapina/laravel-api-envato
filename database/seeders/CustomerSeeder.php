<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a factory instance of Customer with 25 random seeds and each custtomer has 10 Invoices records
        Customer::factory()
            ->count(25)
            ->hasInvoices(10)
            ->create();
        // 100 customers will have only 5 invoices 
        Customer::factory()
            ->count(100)
            ->hasInvoices(5)
            ->create();
        // 100 customers will have only 3 invoices 
        Customer::factory()
            ->count(100)
            ->hasInvoices(3)
            ->create();
        // 5 customers will not have an invoice
        Customer::factory()
            ->count(5)
            ->create();

        // then call the seeder on Database Seeder OR call the seeder on the terminal with --class=CustomerSeeder
    }
}
