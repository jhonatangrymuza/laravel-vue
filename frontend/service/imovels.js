import { http } from './config';

export default {
    listar:() =>{
        return http.get('imovel')
    },

    salvar:(imovel) => {
        return http.post('imovel',imovel)
    },

    atualizar:(imovel) =>{
        return http.put(`imovel/${imovel.id}`,imovel)
    },

    deletar:(id) =>{
        return http.delete(`imovel/${id}`)
    }
}