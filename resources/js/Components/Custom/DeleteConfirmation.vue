<template>
    <div v-if="show" class="z-20 fixed backdrop-blur-sm top-0 bottom-0 left-0 right-0 m-auto flex items-center justify-center bg-black/25">
      <div class="bg-soft-black-3 p-6 pt-5 rounded-lg shadow-lg w-64">
        <h2 class="text-lg font-semibold mb-6 font-albert">Are you sure you want to delete this?</h2>
        <div class="flex justify-around">
            <button @click="cancelDelete" class="bg-red-600 box-content border-b-4 border-red-800 font-medium rounded-lg w-14 h-9 justify-center px-1 text-center inline-flex left-[2.1rem] items-center">
			    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#FFFFFF"/>
			    </svg>
            </button>
            <button @click="confirmDelete" class="text-black border-soft-white-3 bg-soft-white-1 border-b-4 box-content font-medium rounded-lg w-20 h-9 justify-center pl-1 pr-2 text-center inline-flex items-center">
                <svg width="24px" height="22px" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg" aria-labelledby="binIconTitle" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" color="#000000"> <title id="binIconTitle">Bin</title> 
                    <path d="M19 6L5 6M14 5L10 5M6 10L6 20C6 20.6666667 6.33333333 21 7 21 7.66666667 21 11 21 17 21 17.6666667 21 18 20.6666667 18 20 18 19.3333333 18 16 18 10"/>
                </svg>
                <span class="relative top-[0.05rem]">Delete</span>
            </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      show: {
        type: Boolean,
        required: true,
      },
    },
    methods: {
      confirmDelete() {
        this.$emit('confirmed');
      },
      cancelDelete() {
        this.$emit('cancelled');
      },
    },
  };
  </script>

  