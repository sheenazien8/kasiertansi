export default {
  methods : {
    formatPrice(value) {
        let val = (value/1).toFixed().replace('.', ',')

        return "Rp. "+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
  }
}
