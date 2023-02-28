<script>
    class Store extends BaseClass {
        no_set = [];

        before(form) {
        }

        after(form) {

        }


        get submit_data() {
            let data = {
                name: this.name,
                en_name: this.en_name,
                address: this.address,
                en_address: this.en_address,
                phone: this.phone,
                en_phone: this.en_phone,
                email: this.email,
                en_email: this.en_email,
                des: this.des,
                province_id: this.province_id,
                hotline: this.hotline,
                en_hotline: this.en_hotline,
                lat: this.lat,
                long: this.long,
            }
            // console.log(data);
            // return;
            data = jsonToFormData(data);

            return data;
        }
    }
</script>
