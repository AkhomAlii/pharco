
<template>
    <main>
  
      <!-- component -->
  <div class="min-h-screen w-full select-none md:place-items-start bg-gradient-to-b from-gray-800 to-black px-20 py-10 align-middle justify-center">
    <div class="w-full grid place-items-center md:place-items-start">
      <img class="w-40 inline-block" src="https://media.licdn.com/dms/image/C560BAQE-DypT11ozig/company-logo_200_200/0/1552553113357?e=1698883200&v=beta&t=mZbP8fKhPKo9eeHOl-r_CglE5bT9RknW_WHlHTcum50" />
    </div>
  
    <div class=" w-full grid place-items-center mt-4 mb-4 ">
      <p class="rounded-full text-white text-xl md:text-6xl font-normal text-center bg-gray-700">
        <input class="text-blue-500 text-center p-3 rounded-full" v-model="search" @keyup="getCreditor(search)" placeholder="Which Creditor!"> 
      </p>
      <div 
      v-if="this.creditors.length > 0"
      class="overflow-x-auto flex flex-wrap h-44 w-full gap-x-10 gap-y-16 mt-20 justify-center text-center rounded-full pt-1"
      >
  
        <div 
        v-for="(creditor, index) in this.creditors" :key="index"
        class="  w-44 h-44 pt-2 rounded-lg hover:border-4 cursor-pointer bg-[url(https://pbs.twimg.com/profile_images/1356333120992149505/-qvakEK7_400x400.jpg)] bg-cover">
          <!-- <p class="text-gray-300 text-xl md:text-2xl mt-44">Usuário</p> -->
         
          <button class="w-full h-full text-black-500 text-3xl" @click="getPayments(creditor.id)"> {{ creditor.name }}</button>
        </div>
  
      </div>
  
      <div v-if="this.dept" class="flex">
        <p 
        
        class="rounded-lg p-3 text-white text-lg md:text-6xl font-normal text-center bg-gray-700 mt-3  mr-4">
          Dept: {{ this.dept }}
        </p>
        <p
        class="rounded-lg p-3 text-white text-lg md:text-6xl font-normal text-center bg-gray-700 mt-3">
          Only {{ this.remaining }}% left
        </p>
      </div>
    </div>
  
  
    <div 
    v-if="this.addPayment"
    class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                  <th scope="col" class="px-6 py-3">
                      Document
                  </th>
  
                  <th scope="col" class="px-6 py-3">
                      <div class="flex items-center">
                          Due Days
                          
                      </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3">
                      <div class="flex items-center">
                          Expense Code
                      </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3">
                      <div class="flex items-center">
                          Currency
                      </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3">
                      <div class="flex items-center">
                          Exchange Rate
                      </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3">
                      <div class="flex items-center">
                          Amount Type
                      </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3">
                      <div class="flex items-center">
                          Percentage
                      </div>
                  </th>
                  
                  <th scope="col" class="px-6 py-3">
                      <div class="flex items-center">
                          Payment Method
                      </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3">
                      <div class="flex items-center">
                          Notes
                      </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3">
                      
                    <button @click="() => TogglePopup('buttonTrigger')" class="text-lg rounded p-2 bg-gray-800 text-blue-400">Add!</button> 
                       <Popup
                      v-if="popupTrigger.buttonTrigger"
                      :creditor_id="this.creditor_id"
                      :remaining="this.remaining"
                      :TogglePopup="() =>TogglePopup('buttonTrigger')"
                      >
                      </Popup>
                      <!-- <RouterLink to="/payments"  class="text-lg rounded p-2 bg-gray-800 text-blue-400">ADD!</RouterLink>                    -->
                  </th>
              </tr>
          </thead>
          <tbody 
          v-if="this.payments.length > 0"
          >
              <tr 
              v-for="(payment, index) in payments" :key="index"
              class="t-row bg-white border-b dark:bg-gray-800 dark:border-gray-700"
              id="payment.id"
              >
                  <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{ payment.document }}
                  </td>
                  
                  <td class="px-6 py-4">
                      {{ payment.due_days }}
                  </td>
                  
                  <td class="px-6 py-4">
                    {{ payment.expense_code }}
                  </td>
  
                  <td class="px-6 py-4">
                      {{ payment.currency }}
                  </td>
  
                  <td class="px-6 py-4">
                      {{ payment.ex_rate }}
                  </td>
  
                  <td class="px-6 py-4">
                      {{ payment.amount_type }}
                  </td>
  
                  <td class="px-6 py-4">
                      {{ payment.percentage }}
                  </td>
  
                  <td class="px-6 py-4">
                      {{ payment.payment_method }}
                  </td>
  
                  <td class="px-6 py-4">
                      {{ payment.notes }}
                  </td>
  
                  <td class="px-6 py-4 text-right flex">
                      <button @click="() => doSomething(payment.id)" class="text-lg rounded p-2 bg-gray-800 text-blue-400">Edit</button> 
                      </td>
  
                      <button @click="destroy(payment.id)" class="text-lg rounded p-2 bg-gray-800 text-red-400">Delete</button> 
  
              </tr>
            </tbody>
          </table>

        <EditPopup
        v-if="popupTrigger.editTrigger"
        :creditor_id="this.creditor_id"
        :remaining="this.remaining"
        :TogglePopup="() =>TogglePopup('editTrigger')"
        :viewPayment="this.payment"
        class="font-medium text-blue-600 dark:text-blue-500"
        >
            
        </EditPopup>
                   
          </div>
  </div>
  
  
  
    </main>
  </template>
  
  
  
  <script>
  import { ref } from 'vue';
  import Popup from '../components/Popup.vue';
  import axios from 'axios';
  import EditPopup from '../components/EditPopup.vue';
  export default {
      
  
      data() {
          return {
              creditors: [],
              payments: [],
              addPayment: false,
              dept: 0,
              creditor_id : 0,
              remaining : this.remaining,
              search : '',
              timeOut : ()=>{},
              payment : false
          };
      },
      setup() {
        const popupTrigger = ref({
          buttonTrigger : false,
          editTrigger : false
        });
        const TogglePopup = (trigger)=>{
          popupTrigger.value[trigger] = !popupTrigger.value[trigger]
        }  
        return {
              Popup,
              popupTrigger,
              TogglePopup
          };
      },
      mounted() {
      },
      methods: {
        doSomething(indicator){

            // let row = document.getElementsByClassName('t-row')

            for(var i=0; i < this.payments.length; i++){
                if( this.payments[i].id == indicator){
                    // row = row[i]
                    this.payment = this.payments[i]
                }
            }
            this.TogglePopup('editTrigger')

        },  
        getCreditor(search) {
              axios.get(`http://127.0.0.1:8000/api/creditor/${search}`).then(res => {
                  this.creditors = res.data.creditors;
                  this.dept = 0;
                  this.payments = [];
                  this.addPayment = false;
              });
              clearTimeout(this.timeOut)
          },
          getPayments(id) {
              this.addPayment = true;
              if(this.timeOut){
              axios.get(`http://127.0.0.1:8000/api/creditors/${id}`).then(res => {
                  this.creditors = [res.data.creditor];
                  this.payments = res.data.creditor.payments;
                  this.dept = res.data.creditor.dept;
                  this.creditor_id = this.creditors[0].id;
                  this.remaining = res.data.remaining
              });
              }
                   this.timeOut = setTimeout(() => this.getPayments(id), 2000);
                  //  this.timeOut()
              
          },
          destroy(id){
              axios.delete(`http://127.0.0.1:8000/api/payments/${id}`).catch(function (error){
                  if (error.response) {
                  // The request was made and the server responded with a status code
                  // that falls out of the range of 2xx
                  if(error.response.status == 422){
                      mythis.errorList = error.response.data.errors;
                  }
                  console.log(error.response.data);
                  console.log(error.response.status);
                  console.log(error.response.headers);
                  } else if (error.request) {
                  // The request was made but no response was received
                  // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                  // http.ClientRequest in node.js
                  console.log(error.request);
                  } else {
                  // Something happened in setting up the request that triggered an Error
                  console.log('Error', error.message);
                  }
                  console.log(error.config);
              })
          }
      },
      components: { Popup, EditPopup }
  }
  </script>