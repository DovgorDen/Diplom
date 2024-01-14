<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\SecurityCommandCenter\Resource;

use Google\Service\SecurityCommandCenter\ValidateEventThreatDetectionCustomModuleRequest;
use Google\Service\SecurityCommandCenter\ValidateEventThreatDetectionCustomModuleResponse;

/**
 * The "eventThreatDetectionSettings" collection of methods.
 * Typical usage is:
 *  <code>
 *   $securitycenterService = new Google\Service\SecurityCommandCenter(...);
 *   $eventThreatDetectionSettings = $securitycenterService->organizations_eventThreatDetectionSettings;
 *  </code>
 */
class OrganizationsEventThreatDetectionSettings extends \Google\Service\Resource
{
  /**
   * Validates the given Event Threat Detection custom module.
   * (eventThreatDetectionSettings.validateCustomModule)
   *
   * @param string $parent Required. Resource name of the parent to validate the
   * Custom Module under. Its format is: *
   * "organizations/{organization}/eventThreatDetectionSettings". *
   * "folders/{folder}/eventThreatDetectionSettings". *
   * "projects/{project}/eventThreatDetectionSettings".
   * @param ValidateEventThreatDetectionCustomModuleRequest $postBody
   * @param array $optParams Optional parameters.
   * @return ValidateEventThreatDetectionCustomModuleResponse
   */
  public function validateCustomModule($parent, ValidateEventThreatDetectionCustomModuleRequest $postBody, $optParams = [])
  {
    $params = ['parent' => $parent, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('validateCustomModule', [$params], ValidateEventThreatDetectionCustomModuleResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OrganizationsEventThreatDetectionSettings::class, 'Google_Service_SecurityCommandCenter_Resource_OrganizationsEventThreatDetectionSettings');
