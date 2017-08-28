import angular from 'angular';
import CommunicationService from './services/CommunicationService';
import AuthenticationService from './services/AuthenticationService';


let coreModule = angular.module('app.core', [])
  .service('CommunicationService', CommunicationService)
  .service('AuthenticationService', AuthenticationService)
  .name;

export default coreModule;

