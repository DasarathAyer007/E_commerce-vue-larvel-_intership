<template>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-lg border border-gray-200">
    <h1 class="text-2xl font-semibold mb-6 text-center text-gray-800">Payment for Order</h1>

    <div
      ref="cardElement"
      id="card-element"
      class="border border-gray-300 rounded-md p-4 mb-4 focus-within:ring-2 focus-within:ring-blue-400"
    ></div>

    <button
      @click="handlePayment"
      :disabled="loading"
      class="w-full bg-orange-500  text-white font-medium py-3 rounded-md hover:bg-orange-700 disabled:bg-gray-400 transition-colors"
    >
      {{ loading ? 'Processing...' : 'Pay Now' }}
    </button>

    <p v-if="errorMessage" class="mt-4 text-red-500 text-sm text-center">{{ errorMessage }}</p>
  </div>
</template>


<script setup>
import axiosClient from '@/axios';
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { loadStripe } from '@stripe/stripe-js';
import { useToast } from 'vue-toastification';
const toast = useToast();

const route = useRoute();
const router = useRouter();

const elements = ref(null);
const stripe = ref(null);
const clientSecret = ref(null);
const loading = ref(false);
const errorMessage = ref('');

onMounted(async () => {
  const orderId = route.params.id;

  try {
    const resp = await axiosClient.post('api/payment/initiate', { order_id: orderId });
    clientSecret.value = resp.data.clientSecret;

    stripe.value = await loadStripe('pk_test_51S4H3CFuwbBc80uW9XSwHxKCVSAPqJJ9KLyx0QRhK4mmhX5WDWWFYHMimSCWG4R47yi4YPN2Hpy770p5KGtMy4C500oF4H5soJ');

    elements.value = stripe.value.elements({ clientSecret: clientSecret.value });
    const paymentElement = elements.value.create('payment');
    paymentElement.mount('#card-element');

    console.log('Client secret:', clientSecret.value);
  } catch (err) {
    console.error(err);
    errorMessage.value = 'Failed to initialize payment. Please try again.';
  }
});


const handlePayment = async () => {
  if (!stripe.value || !elements.value) return;

  loading.value = true;
  errorMessage.value = '';

  try {
    const result = await stripe.value.confirmPayment({
      elements: elements.value, // stay on page
      redirect: 'if_required',              
    });

    console.log('confirmPayment result:', result);

    if (result.error) {
      errorMessage.value = result.error.message || 'Payment failed';
      return;
    }

    const paymentIntent = result.paymentIntent;
    if (!paymentIntent) {
      toast.warning('Payment requires additional authentication.');
      errorMessage.value = 'Payment requires additional authentication or could not be completed.';
      return;
    }

    // backend verify
    // await axiosClient.post('/api/payment/verify', {
    //   payment_intent_id: paymentIntent.id,
    //   order_id: route.params.id,
    // });
    toast.success('🎉 Payment successful! Your order is confirmed.');
    router.push('/');
    router.push('/');
  } catch (err) {
    console.error('Payment verification failed', err);
    errorMessage.value = 'Payment verification failed';
  } finally {
    loading.value = false;
  }
};

</script>
