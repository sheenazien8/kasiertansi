class RouteService  {
  getUrl(route){
    var route = route.url().replace('http://'+'window.location.host', '');

    return route;
  }
}

export default RouteService = new RouteService();
