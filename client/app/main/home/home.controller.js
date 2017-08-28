"use strict";

import angular from 'angular';

var BASE_URL = "http://localhost:8000/";

class HomeController {
    constructor(CommunicationService, _, $scope, AuthenticationService) {
        "ngInject";

        /*
         Services
         */

        Object.assign(this, {
            CommunicationService,
            _,
            $scope,
            AuthenticationService
        });

        /*
         Properties
         */

        this.pools = [];
        this.currentPool = null;
        this.lines = {};

        this.form = {};

        /*
         Initialize
         */


    }

    /*
     Setters
     */

    /*
     Actions
     */
}

export default HomeController;
