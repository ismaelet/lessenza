<?php

namespace Legacy\System\Classes;

trait ApiInterface {
	/*
	* GET method
	* parameters:
	*	(int) id: the ID of the object
	*	(js array) scope: the requested list of fields
	*	? (js object) set: the properties to be set before giving the response
	*/
	public function API_GET(array $parameters) {
		$response = [];
		$scope = explode(',', $parameters['scope']);
		$setMethods = $this->parseMethods($parameters, 'set');

		foreach ($setMethods as $method => $methodValue) {
			$this->$method($methodValue);
		}

		foreach ($scope as $property) {
			$response[$property] = $this->$property;
		}

		return $response;
	}

	/*
	* PATCH method
	* parameters:
	*	(int) id: the ID of the object
	*	? (js object) update: the properties to be updated
	*/
	public function API_PATCH($parameters) {
		$updateMethods = $this->parseMethods($parameters, 'update');

		if (!empty($updateMethods)) {
			foreach ($updateMethods as $method => $methodValue) {
				$this->$method($methodValue);
			}

			$response = 'updated';

			return $response;
		} else {
			$response['header'] = 'HTTP/1.1 405 Method Not Allowed';
			$response['error'] = 'No class method was defined';

			return $response;
		}
	}

	/*
	* Support methods
	*/
	private function parseMethods(array $parameters, string $category) {
		$methods = [];

		if (isset($parameters['set'])) {
			if (is_array($parameters['set'])) {
				$setRequests = $parameters['set'];
			} else {
				$setRequests = [];

				foreach (explode(',', $parameters['set']) as $setRequest) {
					$setRequest = explode(':', $setRequest);
					$propertyName = $setRequest[0];
					$propertyValue = $setRequest[1];
					$setRequests[$propertyName] = $propertyValue;
				}
			}

			foreach ($setRequests as $propertyName => $propertyValue) {
				$method = $category . ucfirst($propertyName);
				$methods[$method] = $propertyValue;
			}
		}

		return $methods;
	}
}
