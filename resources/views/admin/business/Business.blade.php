<script>
    class Business extends BaseClass {
        before(form) {
            this.image = {};
        }

        after(form) {

        }

        get image() {
            return this._image;
        }

        set image(value) {
            this._image = new Image(value, this);
        }

        get businessVi() {
            return this._business_vi;
        }

        set businessVi(value) {
            this._business_vi = (new BusinessVi(value, this)) ;
        }

        get businessEn() {
            return this._business_en;
        }

        set businessEn(value) {
            this._business_en = (new BusinessEn(value, this)) ;
        }

        get submit_data() {
            let data = {
                business_vi: this.businessVi ? this.businessVi.submit_data : {},
                business_en: this.businessEn ? this.businessEn.submit_data : {},
            }

            data = jsonToFormData(data);
            let image = $(`#${this.image.element_id}`).get(0).files[0];
            if (image) data.append('image', image);
            return data;
        }
    }
</script>
