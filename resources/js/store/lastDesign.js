import { defineStore } from 'pinia';
import axios from 'axios';
import router from '../routes'

export const useLastDesignStore = defineStore("lastDesign", {
    state: () => ({
        presetDesign:{},
        editStatus: false,
    }),
    getters: {
        design: (state) => state.presetDesign,
        status: (state) => state.editStatus,
    },
    actions: {
        async getToken() {
            await axios.get("/sanctum/csrf-cookie");
        },
        async editCustomTeeDesign(id) {
            await this.getToken();
            console.log(id);
            await axios.post("/api/loadPresetDesign", {
                presetCustomTeeID: id,
            }).then((response) => {
                this.presetDesign = response.data[0]
                this.editStatus = true;
                router.push("/customer/design-tool");
            })
        },
        editEmptyCustomTeeDesign(data){
            this.presetDesign = data;
            this.presetDesign.name = "";
            this.presetDesign.front_design_json = '""';
            this.presetDesign.back_design_json =  '""';
            this.editStatus = true;
            router.push("/customer/design-tool");
        },
        setEditStatus(value){
            this.editStatus = value;
        },
        setPresetCustomTee(data){
            this.presetDesign.name = data.name;
            this.presetDesign.front_design_json = data.frontDesignJson;
            this.presetDesign.back_design_json =  data.backDesignJson;
        },
    },
    persist: true,
})