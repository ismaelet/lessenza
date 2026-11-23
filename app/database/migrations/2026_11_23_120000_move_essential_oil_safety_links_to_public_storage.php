<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->replaceLinks('/oli-essenziali/schede_sicurezza/', '/storage/oli-essenziali/schede_sicurezza/');
    }

    public function down(): void
    {
        $this->replaceLinks('/storage/oli-essenziali/schede_sicurezza/', '/oli-essenziali/schede_sicurezza/');
    }

    private function replaceLinks(string $from, string $to): void
    {
        DB::table('products')
            ->where('slug', 'like', 'olio-essenziale-%')
            ->where('description', 'like', '%href="'.$from.'%')
            ->orderBy('id')
            ->chunkById(100, function ($products) use ($from, $to): void {
                foreach ($products as $product) {
                    DB::table('products')->where('id', $product->id)->update([
                        'description' => str_replace('href="'.$from, 'href="'.$to, $product->description),
                    ]);
                }
            });
    }
};
