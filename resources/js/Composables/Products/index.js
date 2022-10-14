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
        let response = await axios.get(route('cart.content'));
        return response.data.cartContent;
    }

    return {
        add,
        getCount,
        getCartContent
    }
}
