import angular from 'angular';
import Home from './home/home';

let componentModule = angular.module('app.main', [
  Home
])
.name;

export default componentModule;
