<script>
    class Project extends BaseClass {
        all_categories = @json(\App\Model\Admin\ProjectCategory::getForSelect());
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

        get projectVi() {
            return this._project_vi;
        }

        set projectVi(value) {
            this._project_vi = (new ProjectVi(value, this)) ;
        }

        get projectEn() {
            return this._project_en;
        }

        set projectEn(value) {
            this._project_en = (new ProjectEn(value, this)) ;
        }

        get submit_data() {
            let data = {
                category_id : this.category_id,
                project_vi: this.projectVi ? this.projectVi.submit_data : {},
                project_en: this.projectEn ? this.projectEn.submit_data : {},
            }

            data = jsonToFormData(data);
            let image = $(`#${this.image.element_id}`).get(0).files[0];
            if (image) data.append('image', image);
            return data;
        }
    }
</script>
