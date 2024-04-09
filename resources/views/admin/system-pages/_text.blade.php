<div class="tab-pane fade show active" role="tabpanel" id="main_tab">
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-8">
                <label for="formTitle">Назва</label>
                <div class="input-wrapper">
                    <input id="formTitle" type="text" name="title" class="form-control"
                           value="{{ old('title', $model->title) }}" required/>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <textarea rows="6" class="form-control ckeditor" name="data[0][body]" placeholder="Вміст" required>{{ old('data.0.body', $model->data[0]['body']) }}</textarea>
            </div>
        </div>
    </div>
</div>

<div class="tab-pane fade" role="tabpanel" id="seo_tab">
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-8">
                <label for="formTitle">Meta Title</label>
                <div class="input-wrapper">
                    <input id="formTitle" type="text" name="meta[title]"
                           class="form-control"
                           value="{{ old('meta.title', $model->meta['title'] ?? '') }}"/>
                    @error('meta.title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="formTitle">Meta Description</label>
                <div class="input-wrapper">
                                                <textarea rows="6" class="form-control"
                                                          name="meta[description]">{!! old('meta.description', $model->meta['description'] ?? '') !!}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
