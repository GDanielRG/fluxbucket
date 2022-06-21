import React from 'react';
import { Fragment, useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import { Order, Product } from '@/types';
import { Dialog, Transition } from '@headlessui/react'
import useRoute from '@/Hooks/useRoute';
import { useForm, InertiaLink } from '@inertiajs/inertia-react';
import { toInteger } from 'lodash';

interface Props {
    products: Array<Product>;
    orders: Array<Order>;
    product?: Product;
}

export default function Home({
    products,
    orders,
    product
}: Props) {
    const [open, setOpen] = product ? useState(true) : useState(false);
    const route = useRoute();

    const form = useForm({
        product_id: product ? product.id : null,
        total: product ? toInteger(product.price * 100) : null,
    });

    function onSubmit(e: React.FormEvent) {
        e.preventDefault();
        form.post(route('orders.store'), { onFinish: () => setOpen(false), });
    }

    return (
        <AppLayout
            title="Home"
        >
            <div className="bg-white">
                <div className="max-w-7xl mx-auto overflow-hidden sm:px-6 lg:px-8">
                    {
                        orders &&
                        <h2 className="text-2xl font-extrabold tracking-tight text-gray-900 mt-12">Your orders</h2>
                    }


                    {
                        orders &&
                        <div className='px-6 sm:px-0'>

                            <table className="w-full text-gray-500 mt-6">
                                <thead className="sr-only text-sm text-gray-500 text-left sm:not-sr-only">
                                    <tr>
                                        <th scope="col" className="sm:w-2/5 lg:w-1/3 pr-8 py-3 font-normal">
                                            Product
                                        </th>
                                        <th scope="col" className="hidden w-1/5 pr-8 py-3 font-normal sm:table-cell">
                                            Price
                                        </th>
                                        <th scope="col" className="hidden pr-8 py-3 font-normal sm:table-cell">
                                            Date
                                        </th>
                                        <th scope="col" className="w-0 py-3 font-normal text-right">
                                            Info
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="border-b border-gray-200 divide-y divide-gray-200 text-sm sm:border-t">
                                    {orders.map((order) => (
                                        <tr key={order.id}>
                                            <td className="py-6 pr-8">
                                                <div className="flex items-center">
                                                    <img
                                                        src={order.product.image}
                                                        className="w-16 h-16 object-center object-cover rounded mr-6"
                                                    />
                                                    <div>
                                                        <div className="font-medium text-gray-900">{order.product.name}</div>
                                                        <div className="mt-1 sm:hidden">{order.formatted_product_price}</div>
                                                        <div className="mt-1 sm:hidden">{order.formatted_created_at}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td className="hidden py-6 pr-8 sm:table-cell">{order.formatted_product_price}</td>
                                            <td className="hidden py-6 pr-8 sm:table-cell">{order.formatted_created_at}</td>
                                            <td className="py-6 font-medium text-right whitespace-nowrap">
                                                <InertiaLink href={route('products.show', { id: order.product.id })} className="text-indigo-600">

                                                    View<span className="hidden lg:inline"> Product</span>
                                                </InertiaLink>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    }

                    <h2 className="text-2xl font-extrabold tracking-tight text-gray-900 mt-12">Our products</h2>
                    <div className="-mx-px border-l border-gray-200 grid grid-cols-2 sm:mx-0 md:grid-cols-3 lg:grid-cols-4 mt-6">
                        {products.map((product) => (
                            <div key={product.id} className="group relative p-4 border-r border-b border-gray-200 sm:p-6">
                                <div className="rounded-lg overflow-hidden bg-gray-200 aspect-w-1 aspect-h-1 group-hover:opacity-75">
                                    <img
                                        src={product.image}
                                        className="w-full h-full object-center object-cover"
                                    />
                                </div>
                                <div className="pt-10 pb-4 text-center">
                                    <h3 className="text-sm font-medium text-gray-900">

                                        <InertiaLink href={route('products.show', { id: product.id })} >
                                            <span aria-hidden="true" className="absolute inset-0" />
                                            {product.name}
                                        </InertiaLink>

                                    </h3>
                                    <p className="mt-4 text-base font-medium text-gray-900">{product.formatted_price}</p>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>


            {product && open &&
                <Transition.Root show={open} as={Fragment}>
                    <Dialog as="div" className="relative z-10 my-12" onClose={setOpen}>
                        <Transition.Child
                            as={Fragment}
                            enter="ease-out duration-300"
                            enterFrom="opacity-0"
                            enterTo="opacity-100"
                            leave="ease-in duration-200"
                            leaveFrom="opacity-100"
                            leaveTo="opacity-0"
                        >
                            <div className="hidden fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity md:block" />
                        </Transition.Child>

                        <div className="fixed z-10 inset-0 overflow-y-auto">
                            <div className="flex items-stretch md:items-center justify-center min-h-full text-center md:px-2 lg:px-4">
                                <span className="hidden md:inline-block md:align-middle md:h-screen" aria-hidden="true">
                                    &#8203;
                                </span>
                                <Transition.Child
                                    as={Fragment}
                                    enter="ease-out duration-300"
                                    enterFrom="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
                                    enterTo="opacity-100 translate-y-0 md:scale-100"
                                    leave="ease-in duration-200"
                                    leaveFrom="opacity-100 translate-y-0 md:scale-100"
                                    leaveTo="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
                                >
                                    <Dialog.Panel className="flex text-base text-left transform transition w-full md:max-w-2xl md:px-4 md:my-8 lg:max-w-4xl">

                                        <div className="w-full relative flex items-center bg-white px-4 pt-14 pb-8 overflow-hidden shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8">
                                            <button
                                                type="button"
                                                className="absolute top-4 right-4 text-gray-400 hover:text-gray-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8"
                                                onClick={() => setOpen(false)}
                                            >
                                                <span className="sr-only">Close</span>
                                                X
                                            </button>

                                            <div className="w-full grid grid-cols-1 gap-y-8 gap-x-6 items-start sm:grid-cols-12 lg:items-center lg:gap-x-8">
                                                <div className="aspect-w-2 aspect-h-3 rounded-lg bg-gray-100 overflow-hidden sm:col-span-4 lg:col-span-5">
                                                    <img src={product.image} className="object-center object-cover" />
                                                </div>
                                                <div className="sm:col-span-8 lg:col-span-7">
                                                    <h2 className="text-xl font-medium text-gray-900 sm:pr-12">{product.name}</h2>

                                                    <section aria-labelledby="information-heading" className="mt-1">
                                                        <h3 id="information-heading" className="sr-only">
                                                            Product information
                                                        </h3>

                                                        <p className='mb-2'>{product.description}</p>

                                                        <p className="font-medium text-gray-900">{product.formatted_price}</p>

                                                    </section>

                                                    <section aria-labelledby="options-heading" className="mt-8">
                                                        <h3 id="options-heading" className="sr-only">
                                                            Product options
                                                        </h3>

                                                        <form onSubmit={onSubmit}>


                                                            <button
                                                                type="submit"
                                                                className="mt-8 w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                            >
                                                                Order
                                                            </button>

                                                        </form>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </Dialog.Panel>
                                </Transition.Child>
                            </div>
                        </div>
                    </Dialog>
                </Transition.Root>
            }
        </AppLayout>
    );
}
