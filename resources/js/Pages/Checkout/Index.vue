<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {router, useForm} from '@inertiajs/vue3';
import FormGroup from "@/Components/Form/FormGroup.vue";

interface CartProduct {
    name: string,
    sku: string,
    colour: string,
    size: string,
    quantity: string,
    price: float,
}

const props = defineProps<{
    products: Array<CartProduct>,
    addresses: Array<object>,
    total: number
}>();

const form = useForm<{
    redirect: boolean,
    first_name: string,
    last_name: string,
    phone_number: string,
    street_address_1: string,
    street_address_2: string,
    town: string,
    county: string,
    postcode: string,
    country: string,
    address_id: string
}>({
    redirect: false,
    first_name: 'John',
    last_name: 'Wick',
    phone_number: '07766776677',
    street_address_1: 'The Continental Hotel',
    street_address_2: null,
    town: 'New York',
    county: 'New York',
    postcode: 'NR11 8TE',
    country: 'United Kingdom',
    address_id: props.addresses.length ? props.addresses[0]['id'] : -1
});

const handleSubmit = (): void => {
    form.post(route('checkout.store'), {
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <GuestLayout title="Cart">
        <div class="container mx-auto">
            <template v-if="products.length">
                <div class="grid grid-cols-2 gap-2">
                    <div class="p-5 rounded-lg">
                        <form @submit.prevent="handleSubmit" method="post">
                            <template v-if="addresses.length">
                                <h2 class="text-xl mb-3">Where should we send it</h2>
                                <template v-for="address in addresses">
                                    <div class="border mb-3 px-3 py-2">
                                        <label class="flex flex-row items-center">
                                            <input
                                                type="radio"
                                                id="address_id"
                                                name="address_id"
                                                :value="address.id"
                                                v-model="form.address_id"
                                            />
                                            <ul class="pl-3">
                                                <li>{{ address.first_name }} {{ address.last_name }}</li>
                                                <li>{{ address.street_address_1 }}</li>
                                                <template v-if="address.street_address_2">
                                                    <li>{{ address.street_name_2 }}</li>
                                                </template>
                                                <li>{{ address.town }}, {{ address.county }}, {{ address.postcode }}</li>
                                                <li>{{ address.country }}</li>
                                                <li>{{ address.phone_number }}</li>
                                            </ul>
                                        </label>
                                    </div>
                                </template>
                                <div class="py-5">- or -</div>
                            </template>

                            <div class="border mb-3 px-3 py-2 flex flex-col" @click="form.address_id=-1">

                                <div class="flex flex-row items-center mb-3">
                                    <label class="text-xl">
                                        <input type="radio" id="address_id" name="address_id" value="-1" @click="form.address_id=-1" v-model="form.address_id"/>
                                        <span class="pl-3">Add address</span>
                                    </label>
                                </div>

                                <FormGroup
                                    label="First name"
                                    name="first_name"
                                    required
                                    single-column
                                >
                                    <input v-model="form.first_name" type="text" id="first_name" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </FormGroup>

                                <FormGroup
                                    label="Last name"
                                    name="last_name"
                                    required
                                    single-column
                                >
                                    <input v-model="form.last_name" type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </FormGroup>

                                <FormGroup
                                    label="Phone number"
                                    name="phone_number"
                                    required
                                    single-column
                                >
                                    <input v-model="form.phone_number" type="text" id="phone_number" name="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </FormGroup>

                                <FormGroup
                                    label="Street address"
                                    name="street_address_1"
                                    required
                                    single-column
                                >
                                    <input v-model="form.street_address_1" type="text" id="street_address_1" name="street_address_1" class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <input v-model="form.street_address_2" type="text" id="street_address_2" name="street_address_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </FormGroup>

                                <FormGroup
                                    label="Town"
                                    name="town"
                                    required
                                    single-column
                                >
                                    <input v-model="form.town" type="text" id="town" name="town" class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </FormGroup>

                                <FormGroup
                                    label="County"
                                    name="county"
                                    required
                                    single-column
                                >
                                    <input v-model="form.county" type="text" id="county" name="county" class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </FormGroup>

                                <FormGroup
                                    label="Postcode"
                                    name="postcode"
                                    required
                                    single-column
                                >
                                    <input v-model="form.postcode" type="text" id="postcode" name="postcode" class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </FormGroup>

                                <FormGroup
                                    label="Country"
                                    name="country"
                                    required
                                    single-column
                                >
                                    <select v-model="form.country" name="country" id="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="" disabled>Select country...</option>
                                        <option data-title="Guernsey" value="Guernsey">Guernsey</option>
                                        <option data-title="Ireland" value="Ireland">Ireland</option>
                                        <option data-title="Isle of Man" value="Isle of Man">Isle of Man</option>
                                        <option data-title="Jersey" value="Jersey">Jersey</option>
                                        <option data-title="United Kingdom" value="United Kingdom">United Kingdom</option>
                                    </select>
                                </FormGroup>
                            </div>

                            <div class="flex items-start mb-6">
                                <div class="flex items-center h-5">
                                    <input checked id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" required>
                                </div>
                                <label for="remember" class="ml-2 text-sm font-medium text-gray-500">I agree with the <a href="#" class="text-blue-600 hover:underline">terms and conditions</a>.</label>
                            </div>
                            <div class="flex flex-row pt-5">
                                <button type="submit" class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 ml-2 mb-2 focus:outline-none">Proceed to Payment</button>
                            </div>
                        </form>
                    </div>

                    <div class="p-5">
                        <h2 class="text-xl mb-5 font-bold">Order summary</h2>
                        <div class="flex flex-row justify-between">
                            <div>
                                Sub-Total
                            </div>
                            <div class="text-lg">
                                &pound;{{ Math.round((total / 120) * 100) }}
                            </div>
                        </div>
                        <div class="flex flex-row justify-between">
                            <div>
                                VAT
                            </div>
                            <div class="text-lg">
                                &pound;{{ Math.round(total - (total / 120) * 100) }}
                            </div>
                        </div>
                        <div class="flex flex-row justify-between font-bold">
                            <div>
                                Total
                            </div>
                            <div class="text-xl">
                                &pound;{{ total }}
                            </div>
                        </div>

                        <hr class="my-5">

                        <h2 class="text-xl mb-3">Items in cart</h2>
                        <div class="grid grid-cols-2 gap-2">
                            <template v-for="details in products">
                                <img :src="details.image" alt="image" class="h-48"/>

                                <div class="flex flex-col">
                                    <p class="text-md uppercase">{{ details.name }}</p>
                                    <p class="">Sku: <span class="uppercase text-gray-500">{{ details.sku }}</span></p>
                                    <p class="">Colour: <span class="uppercase text-gray-500">{{ details.colour }}</span></p>
                                    <p class="">Size: <span class="uppercase text-gray-500">{{ details.size }}</span></p>

                                    <div class="text-xl my-2">&pound;{{ details.price }}</div>

                                    <div class="text-xl my-2"> Qty: {{ details.quantity }}</div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                Your cart is empty!
            </template>
        </div>
    </GuestLayout>
</template>