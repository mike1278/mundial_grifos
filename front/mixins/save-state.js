import pickBy from 'lodash/pickBy';
import forEach from 'lodash/forEach';
import _debounce from "lodash/debounce"
import { saveState, getSavedState, clearSavedState } from '@/functions/local-storage';

export default {
    watch: {
        '$data': {
            handler() {
                this.debounceSaveState();
            },
            deep: true,
        },
    },
    created() {
        this.debounceSaveState=_debounce(this.saveState,350);
    },
    mounted() {
        if(process.client){
            this.loadState();
        }
    },
    methods: {
        loadState() {

            const savedState = getSavedState(this.getSaveStateConfig().cacheKey);

            if (!savedState) {
                return;
            }
            try {
                forEach(savedState, (value, key) => {
                    if (this.attributeIsManagedBySaveState(key)) {
                        if (this.getSaveStateConfig().onLoad) {
                            value = this.getSaveStateConfig().onLoad(key, value);
                        }

                        this.$data[key] = value;
                    }
                });
            }catch (e){}
        },

        saveState() {
            const data = pickBy(this.$data, (value, attribute) => {
                return this.attributeIsManagedBySaveState(attribute);
            });

            saveState(this.getSaveStateConfig().cacheKey, data);
        },
        attributeIsManagedBySaveState(attribute) {
            if (this.getSaveStateConfig().ignoreProperties &&
                this.getSaveStateConfig().ignoreProperties.indexOf(attribute) !== -1) {
                return false;
            }

            if (! this.getSaveStateConfig().saveProperties) {
                return true;
            }

            return this.getSaveStateConfig().saveProperties.indexOf(attribute) !== -1;
        },
        clearSavedState() {
            clearSavedState(this.getSaveStateConfig().cacheKey);
        },
    },
};