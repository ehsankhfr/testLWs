import template from './home.html';
import controller from './home.controller';
import './home.scss';

let homeComponent = {
    restrict: 'E',
    bindings: {},
    template,
    controller,
    controllerAs: 'homeCtrl'
};

export default homeComponent;
