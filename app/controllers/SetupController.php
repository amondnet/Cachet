<?php

	class SetupController extends Controller {
		public function showSetup() {
			return View::make('setup')->with([
				'pageTitle' => 'Setup'
			]);
		}

		public function setupCachet() {
			$postData = Input::get();
			$v = Validator::make($postData, [
				'app_name' => 'required',
				'app_domain' => 'url|required',
				'show_support' => 'boolean'
			]);

			if ($v->passes()) {
				// Create the settings, boi.
				foreach ($postData as $settingName => $settingValue) {
					$setting = new Setting;
					$setting->name = $settingName;
					$setting->value = $settingValue;
					$setting->save();
				}
				return Redirect::to('/');
			} else {
				// No good, let's try that again.
				return Redirect::back()->with('errors', $v->messages());
			}
		}
	}
