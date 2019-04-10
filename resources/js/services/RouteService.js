class RouteService  {
  getUrl(route){
    var routes = route.url().replace('http://'+window.location.host, '');

    return routes;
  }
}

export default RouteService = new RouteService();
