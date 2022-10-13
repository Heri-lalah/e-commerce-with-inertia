export default function useProduct(){
    const add = async(productId)=>{
        let response = await axios.post('/api/products',{
            productId :  productId
        });
    }

    const getCount = async() => {
        let response = await axios.get(route('products.count'));
        return response.data.count;
    }

    return {
        add,
        getCount
    }
}