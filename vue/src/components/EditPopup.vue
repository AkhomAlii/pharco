<template>
	<div class="popup">
		<div class="w-full m-5 relative overflow-x-auto shadow-md sm:rounded-lg ">
			<slot />


			<table class="w-full  text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Document
					{{ viewPayment.id }}
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
                    
                  <button @click="savePayment()" class="text-lg rounded p-2 bg-gray-800 text-blue-400">Update</button>
                    
                </th>
            </tr>
        </thead>
        <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <tr>
				<td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <select 
					name="DOCUMENT"
					v-model="model.payment.DOCUMENT"					                      
					id="DOCUMENT" 
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					required>
					<option value="Late Pay">Late Pay</option>
						<option value="Advanced">Advanced</option>
						<option value="Exchange">Exchange</option>
						<option value="Refund">Refund</option>
					</select>
                </td>
                
                <td class="px-6 py-4">
					<input
					name="DUE_DAYS"
					v-model="model.payment.DUE_DAYS"
					type="number"
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-2 pr-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					id="DUE_DAYS"
					placeholder="Days Number" 
					required/>
                </td>
                
                <td class="px-6 py-4">
					<select 
					name="EXPENSE_CODE"
					v-model="model.payment.EXPENSE_CODE"
					id="EXPENSE_CODE" 
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-2 pr-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					required>
						<option value="Percent">Total Value</option>
					</select>
                </td>

                <td class="px-6 py-4">
					<select 
					name="CURRENCY"
					v-model="model.payment.CURRENCY"
					id="CURRENCY" 
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-2 pr-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					required>
						<option value="USD">USD</option>
						<option value="UAE">UAE</option>
						<option value="EUR">EUR</option>
						<option value="EGP">EGP</option>
					</select>
                </td>

                <td class="px-6 py-4">
                    <input
					name="EX_RATE"
					v-model="model.payment.EX_RATE"
					type="number"
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-2 pr-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					id="exchange_rate"
					step="0.1"
					required/>
                </td>

                <td class="px-6 py-4">
					<select 
					v-model="model.payment.AMOUNT_TYPE"
					id="AMOUNT_TYPE" 
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-2 pr-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					required>
						<option disabled selected>What type</option>
						<option value="Percent">Percent</option>
					</select>
                </td>

                <td class="px-6 py-4">
                    <input
					name="PERCENTAGE"
					v-model="model.payment.PERCENTAGE"
					type="number"
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-2 pr-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					id="percentage"
					required/>
                </td>

                <td class="px-6 py-4">
					<select 
					name="PAYMENT_METHOD"
					v-model="model.payment.PAYMENT_METHOD"
					id="PAYMENT_METHOD"                        
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-2 pr-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					required>
						<option disabled selected>What method</option>
						<option value="Cash">Cash</option>
						<option value="Visa">Visa</option>
						<option value="Cheque">Cheque</option>
					</select>
                </td>

                <td class="px-6 py-4">
					<textarea 
					name="NOTES"
					v-model="model.payment.NOTES"
					id="NOTES" 
					rows="1" 
					class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
					placeholder="Your Notes..."
					required></textarea>


                </td>

                <td class="px-6 py-4 text-right">
                    <button @click="TogglePopup()" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Cancel</button>

                    
                </td>
            </tr>
			<tr v-if="Object.keys(this.errorList).length > 0">
				<td 
				v-for="(error, index) in this.errorList"
				:key="index"
				class="px-6 py-4 text-right">
					{{ error[0] }}
                    
                </td>
			</tr>
          </tbody>
        </table>


		
		
	</div>
</div>
	
</template>


<script>
import axios from 'axios';

export default {
	props: ['TogglePopup', 'remaining', 'viewPayment'],
	data(){
		return {
			errorList : '',
			model : {
				payment : {
					creditor_id: this.viewPayment.creditor_id,
					DOCUMENT:this.viewPayment.document,
					DUE_DAYS: this.viewPayment.due_days,
					EXPENSE_CODE: this.viewPayment.expense_code,
					CURRENCY: this.viewPayment.currency,
					EX_RATE: this.viewPayment.ex_rate,
					AMOUNT_TYPE: this.viewPayment.amount_type,
					PERCENTAGE: this.viewPayment.percentage,
					PAYMENT_METHOD: this.viewPayment.payment_method,
					NOTES: this.viewPayment.notes
				},
				remaining: this.remaining
			}
		}
	},
	
	methods:{
		savePayment(){
			var mythis = this;
			console.log(this.model.payment)
			axios.put(`http://localhost:8000/api/payments/${this.viewPayment.id}`, this.model.payment)
			.then(res => {
				// alert(res.data);

				this.model.payment = {
					creditor_id: `0`,
					DOCUMENT: '',
					DUE_DAYS: `0`,
					EXPENSE_CODE: '',
					CURRENCY: '',
					EX_RATE: `0.0`,
					AMOUNT_TYPE: '',
					PERCENTAGE: '',
					PAYMENT_METHOD: '',
					NOTES: ''
				}
				if(res.status == 200){
					this.TogglePopup();
					
				}
			}).catch(function (error){
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

}

</script>

<style scoped>
.popup {
	position: fixed;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 99;
	background-color: rgba(234, 229, 229, 0.716);
	
	display: flex;
	align-items: center;
	justify-content: center;

	.popup-inner {
		background: #343333;
		padding: 32px;
	}
}
</style>