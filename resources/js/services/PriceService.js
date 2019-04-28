class PriceService  {
  formatPrice(value) {
    let val = (value/1).toFixed(2).replace('.', ',')
    console.log(val)
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
  }
}

export default PriceService = new PriceService();
