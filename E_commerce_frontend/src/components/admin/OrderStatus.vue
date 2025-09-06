<template>

    <label class="text-gray-700 font-medium mr-2">Order Status:</label>
            <select
              v-model="status"
              @change="updateStatus"
              :class="[
                'border rounded px-2 py-1 focus:outline-none focus:ring-2',
                {
                  'bg-yellow-100 border-yellow-400 text-yellow-800 focus:ring-yellow-400':
                    status === 'pending',
                  'bg-blue-100 border-blue-400 text-blue-800 focus:ring-blue-400':
                    status === 'processing',
                  'bg-purple-100 border-purple-400 text-purple-800 focus:ring-purple-400':
                    status === 'shipped',
                  'bg-green-100 border-green-400 text-green-800 focus:ring-green-400':
                    status === 'delivered',
                  'bg-red-100 border-red-400 text-red-800 focus:ring-red-400':
                    status === 'cancelled',
                },
              ]"
            >
              <option value="pending">Pending</option>
              <option value="processing">Processing</option>
              <option value="shipped">Shipped</option>
              <option value="delivered">Delivered</option>
              <option value="cancelled">Cancelled</option>
            </select>
</template>

<script setup>
import { defineProps,watch,ref } from 'vue';
import axiosClient from '@/axios';


const props=defineProps({
    orderId:{
        type:Number,
        required:true
    },
    initialStatus:{
        type:String,
        required:true
    }
})


const status=ref(props.initialStatus)

watch(
  () => props.initialStatus,
  (newStatus, oldStatus) => {
    status.value = newStatus
  },
  { immediate: true } 
)

function updateStatus() {
  axiosClient
    .put(`api/order/${props.orderId}`, { status: status.value })
    .then((resp) => console.log("Status updated:", resp.data))
    .catch((err) => console.error(err));
}

</script>