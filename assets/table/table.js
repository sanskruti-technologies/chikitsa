new Vue({
  el: '#app',
  data: () => ({
    pagination: {
      sortBy: 'sr' },

    selected: [],
    search: '',
    isMobile: false,
    headers: [
      {
        text: 'sr',
        value: 'sr' },
      {
      text: 'Dessert (100g serving)',
      align: 'left',
      value: 'name' },

    {
      text: 'Calories',
      value: 'calories' },

    {
      text: 'Fat (g)',
      value: 'fat' },

    {
      text: 'Carbs (g)',
      value: 'carbs' },

    {
      text: 'Protein (g)',
      value: 'protein' },

    {
      text: 'Iron (%)',
      value: 'iron' }],


    desserts: [{
      
      value: false,
      sr: 3,
      name: 'Frozen Yogurt1111',
      calories: 159,
      fat: 6.0,
      carbs: 24,
      protein: 4.0,
      iron: '1%' },

    {
      value: false,
      sr: 4,
      name: 'Ice cream sandwich',
      calories: 237,
      fat: 9.0,
      carbs: 37,
      protein: 4.3,
      iron: '1%' },

    {
      value: false,
      sr: 5,
      name: 'Eclair',
      calories: 262,
      fat: 16.0,
      carbs: 23,
      protein: 6.0,
      iron: '7%' },

    {
      value: false,
      sr: 6,
      name: 'Cupcake',
      calories: 305,
      fat: 3.7,
      carbs: 67,
      protein: 4.3,
      iron: '8%' },

    {
      value: false,
      sr: 7,
      name: 'Gingerbread',
      calories: 356,
      fat: 16.0,
      carbs: 49,
      protein: 3.9,
      iron: '16%' },

    {
      value: false,
      sr: 8,
      name: 'Jelly bean',
      calories: 375,
      fat: 0.0,
      carbs: 94,
      protein: 0.0,
      iron: '0%' },

    {
      value: false,
      sr: 9,
      name: 'Lollipop',
      calories: 392,
      fat: 0.2,
      carbs: 98,
      protein: 0,
      iron: '2%' },

    {
      value: false,
      sr: 10,
      name: 'Honeycomb',
      calories: 408,
      fat: 3.2,
      carbs: 87,
      protein: 6.5,
      iron: '45%' },

    {
      value: false,
      sr: 10,
      name: 'Donut',
      calories: 452,
      fat: 25.0,
      carbs: 51,
      protein: 4.9,
      iron: '22%' },

    {
      value: false,
      sr: 10,
      name: 'KitKat',
      calories: 518,
      fat: 26.0,
      carbs: 65,
      protein: 7,
      iron: '6%' }] }),

  methods: {
    onResize() {
      if (window.innerWidth < 769)
      this.isMobile = true;else

      this.isMobile = false;
    },
    toggleAll() {
      if (this.selected.length) this.selected = [];else
      this.selected = this.desserts.slice();
    },
    changeSort(column) {
      console.log(column);
      if (this.pagination.sortBy === column) {
        this.pagination.descending = !this.pagination.descending;
      } else {
        this.pagination.sortBy = column;
        this.pagination.descending = false;
      }
    } } });