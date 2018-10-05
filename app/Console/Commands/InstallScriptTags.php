<?php

namespace App\Console\Commands;

use App\Models\Shop;
use Illuminate\Console\Command;
use OhMyBrew\ShopifyApp\Jobs\ScripttagInstaller;

class InstallScriptTags extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'shopify:script-tags';
	
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install script tags for all shops where they are not installed';
	
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$scripttags = config('shopify-app.scripttags');
		if (count($scripttags) > 0) {
			foreach (Shop::all() as $shop){
				$this->info("Installing on {$shop->shopify_domain}");
				try {
					dispatch(
						new ScripttagInstaller($shop, $scripttags)
					);
					$this->info("Installed on {$shop->shopify_domain}");
				} catch (\Exception $exception){
					$this->info("Not installed on {$shop->shopify_domain}");
				}
			}
		}
	}
}
