import HomeModule from './home'
import _ from 'lodash';

describe('Home', () => {
  let $rootScope, $state, $location, $componentController, $compile, CommunicationService, _;

  beforeEach(window.module(HomeModule));

  beforeEach(window.module(function ($provide) {
    $provide.value('_', _);
  }));

  beforeEach(inject(($injector) => {
    $rootScope = $injector.get('$rootScope');
    $componentController = $injector.get('$componentController');
    $state = $injector.get('$state');
    $location = $injector.get('$location');
    $compile = $injector.get('$compile');
    CommunicationService = $injector.get('CommunicationService');
  }));
});
