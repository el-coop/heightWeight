<?php

namespace App\Http\Controllers;

use App\Events\Shop\ShopCreated;
use Carbon\Carbon;
use Illuminate\Http\Request;
use OhMyBrew\ShopifyApp\Libraries\BillingPlan;
use OhMyBrew\ShopifyApp\Traits\BillingControllerTrait;
use ShopifyApp;

class InstallController extends Controller {

	use BillingControllerTrait;

	public function ProcessBilling() {
		// Setup the shop and get the charge ID passed in
		$shop = ShopifyApp::shop();
		$chargeId = request('charge_id');

		// Setup the plan and get the charge
		$plan = new BillingPlan($shop, $this->chargeType());
		$plan->setChargeId($chargeId);

		// Check the customer's answer to the billing
		$charge = $plan->getCharge();
		if ($charge->status == 'accepted') {
			// Customer accepted, activate the charge
			$plan->activate();

			// Save the charge ID to the shop
			$shop->charge_id = $chargeId;
			$shop->trial_end = Carbon::now()->addDays(env('SHOPIFY_BILLING_TRIAL_DAYS', 0));
			$shop->save();
			event(new ShopCreated($shop));

			// Go to homepage of app
			return redirect()->route('home');
		} else {
			// Customer declined the charge, abort
			return abort(403, 'It seems you have declined the billing charge for this application');
		}
	}
}
