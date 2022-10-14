import axios from "axios";

export default function useProduct(){
    const add = async(productId)=>{
        let response = await axios.post('/api/products',{
            productId :  productId
        });

        return response.data.count;

    }

    const getCount = async() => {
        let response = await axios.get(route('products.count'));
        return response.data.count;
    }

    const getCartContent= async () => {
        let response = await axios.get('/api/products');
        return response.data.cartContent;
    }

    const formated_price = (price) => {
        return price / 100 + " €";
    }

    const increaseQuantity = async(id) => {
        await axios.get('/api/product/increase/' + id);
    }

    const decreaseQuantity = async(id) => {
        await axios.get('/api/product/decrease/' + id);
    }

    const destroyProduct = async(id) => {
        await axios.delete('/api/product/increase/' + id);
    }
    return {
        add,
        getCount,
        getCartContent,
        formated_price,
        increaseQuantity,
        decreaseQuantity,
        destroyProduct
    }
}
