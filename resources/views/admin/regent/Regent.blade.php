<script>
    class Regent extends BaseClass {
        no_set = [];

        before(form) {
            this.image = {};
            this.sort_order = 1;
            // this.regentVi = (new RegentVi(form.regentVi, this));
        }

        after(form) {

        }

        get image() {
            return this._image;
        }

        set image(value) {
            this._image = new Image(value, this);
        }

        get regentVi() {
            return this._regent_vi;
        }

        set regentVi(value) {
            this._regent_vi = (new RegentVi(value, this)) ;

        }

        get regentEn() {
            return this._regent_en;
        }

        set regentEn(value) {
            this._regent_en = value ? (new RegentEn(value, this)) : (new RegentEn({}, this));
        }

        get submit_data() {
            let data = {
                regent_vi: this.regentVi ? this.regentVi.submit_data : {},
                regent_en: this.regentEn ? this.regentEn.submit_data : {},
                email: this.email,
                phone_number: this.phone_number,
                date_of_birth: this.date_of_birth,
                sex: this.sex,
                sort_order: this.sort_order,
            }

            data = jsonToFormData(data);
            let image = $(`#${this.image.element_id}`).get(0).files[0];
            if (image) data.append('image', image);

            return data;
        }
    }
</script>
