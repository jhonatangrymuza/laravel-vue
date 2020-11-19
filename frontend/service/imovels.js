import { http } from './config';

export default {
    listar: async () =>{
        return await http.get('imovel')
    },

    salvar: async (imovel) => {
        return await http.post('imovel',imovel)
    },

    atualizar: async (imovel) =>{
        return await http.put(`imovel/${imovel.id}`,imovel)
    },

    deletar: async (id) =>{
        return await http.delete(`imovel/${id}`)
    }
}