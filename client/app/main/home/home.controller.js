"use strict";

import angular from 'angular';
import $ from "jquery";

var BASE_URL = "http://localhost:8000/";

class HomeController {
  constructor(CommunicationService, _, $scope, AuthenticationService, $interval) {
    "ngInject";

    /*
     Services
     */

    Object.assign(this, {
      CommunicationService,
      _,
      $scope,
      AuthenticationService,
      $interval
    });

    /*
     Properties
     */

    this.form = {};
    this.interval = null;
    this.idleTime = 0;

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
  login() {
    if (
      (this.form.password || this.form.password.trim().length < 8 || this.form.password.trim().length > 15) ||
      (this.form.username || this.form.username.trim().length < 2 || this.form.username.trim().length > 30)
    ) {
      this.error = "The entered information is not valid";
    }

    return this.CommunicationService.post(`${BASE_URL}api/version1/user/login`, this.form).then((response)=> {
      this.AuthenticationService.register(response);
      this.registerIdleChecker();
    }).catch(
      (err)=> {
        console.log(err);
      }
    );
  }

  registerIdleChecker() {
    this.interval = this.$interval(()=> {
      this.idleTime = this.idleTime + 1;
      if (this.idleTime > 0)
        this.logout();
    }, 60000); // 1 minute

    $(document).mousemove((e)=> {
      this.idleTime = 0;
    });
    $(document).keypress((e)=> {
      this.idleTime = 0;
    });
  }

  logout() {
    let _form = {
      userid: this.AuthenticationService.user.userid
    };

    return this.CommunicationService.post(`${BASE_URL}api/version1/user/logout`, this.form).then((response)=> {
      this.AuthenticationService.reset();
      this.$interval.cancel(this.interval);
    }).catch((err)=> {
      console.log(err);
    });

  }

}

export default HomeController;
