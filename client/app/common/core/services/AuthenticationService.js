"use strict";
class AuthenticationService {
  constructor($cookies, $cookieStore) {
    "ngInject";
    this.isAuthenticated = false;
    this.user = {};

    Object.assign(
      this, {
        $cookies,
        $cookieStore
      }
    );
  }

  /*
   ACTIONS
   */

  reset() {
    this.isAuthenticated = false;
    this.$cookieStore.remove("userid");
    this.user = {};
  }

  register(info) {
    this.user = {
      userid: info.userid
    };

    this.isAuthenticated = true;
    this.$cookieStore.put("userid", info.userid);
  }
}

export default AuthenticationService;

