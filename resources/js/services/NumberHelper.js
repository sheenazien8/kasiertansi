export default class NumberHelper  {
  formatPrice(value) {
     let val = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')

     return val
   }
}

