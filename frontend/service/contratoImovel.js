import { http } from './config';

export default {
    listar: async () =>{
        return await http.get('contrato')
    },

    salvar: async (contrato) => {
        return await http.post('contrato',contrato)
    },

    atualizar: async (contrato) =>{
        return await http.put(`contrato/${contrato.id_contrato}`,contrato)
    },

    deletar: async (id) =>{
        return await http.delete(`contrato/${id}`)
    }
}