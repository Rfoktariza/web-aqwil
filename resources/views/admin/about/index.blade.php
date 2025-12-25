@extends('admin.layouts.admin')
@section('title', 'Edit About Us')

@section('content')
    <div class="container ">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header     py-3 rounded-top-4">
                <h4 class="mb-0"> Edit About Us</h4>
            </div>

            {{-- Alert --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf



                    {{-- 🔹 Section: About Content --}}
                    <h5 class="fw-bold text-primary mb-3"><i class="bi bi-file-earmark-text me-2"></i>Main Content</h5>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $about->title) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subtitle</label>
                        <textarea name="content_1" rows="4" class="form-control">{{ old('content_1', $about->content_1) }}</textarea>
                    </div>



                    <hr class="my-4">

                    {{-- 🔹 Section: Vision --}}
                    <h5 class="fw-bold text-primary mb-3"><i class="bi bi-eye me-2"></i>Vision</h5>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Vision Title</label>
                        <input type="text" name="vision_title" class="form-control"
                            value="{{ old('vision_title', $about->vision_title) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Vision Content</label>
                        <div id="vision_editor" class="form-control" style="height: 200px;">{!! old('vision_content', $about->vision_content) !!}</div>
                        <textarea name="vision_content" id="vision_content" class="d-none">{!! old('vision_content', $about->vision_content) !!}</textarea>
                    </div>

                    <hr class="my-4">

                    {{-- 🔹 Section: Mission --}}
                    <h5 class="fw-bold text-primary mb-3"><i class="bi bi-bullseye me-2"></i>Mission</h5>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mission Title</label>
                        <input type="text" name="mission_title" class="form-control"
                            value="{{ old('mission_title', $about->mission_title) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mission Content</label>
                        <div id="mission_editor" class="form-control" style="height: 200px;">{!! old('mission_content', $about->mission_content) !!}</div>
                        <textarea name="mission_content" id="mission_content" class="d-none">{!! old('mission_content', $about->mission_content) !!}</textarea>
                    </div>

                    {{-- 🔹 Section: Innovation --}}
                    <h5 class="fw-bold text-primary mb-3 mt-5"><i class="bi bi-lightbulb me-2"></i>Innovation</h5>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Innovation Title</label>
                        <input type="text" name="innovation_title" class="form-control"
                            value="{{ old('innovation_title', $about->innovation_title) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Innovation Content</label>
                        <div id="innovation_editor" class="form-control" style="height: 200px;">{!! old('innovation_content', $about->innovation_content) !!}
                        </div>
                        <textarea name="innovation_content" id="innovation_content" class="d-none">{!! old('innovation_content', $about->innovation_content) !!}</textarea>
                    </div>

                    <hr class="my-4">

                    {{-- 🔹 Input Data Count --}}
                    <h5 class="fw-bold text-primary mb-3"><i class="bi bi-graph-up me-2"></i>Data Pelanggan</h5>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Jumlah Klinik</label>
                            <input type="number" name="clinic_count" class="form-control"
                                value="{{ old('clinic_count', $about->clinic_count) }}" min="0">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Jumlah Rumah Sakit</label>
                            <input type="number" name="hospital_count" class="form-control"
                                value="{{ old('hospital_count', $about->hospital_count) }}" min="0">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Jumlah Partner</label>
                            <input type="number" name="partner_count" class="form-control"
                                value="{{ old('partner_count', $about->partner_count) }}" min="0">
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="bi bi-save me-2"></i>Save Changes
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    {{-- 🔹 Quill Initialization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const makeQuill = (id, textareaId) => {
                const quill = new Quill(id, {
                    theme: 'snow'
                });
                quill.root.innerHTML = document.getElementById(textareaId).value;
                quill.on('text-change', () => {
                    document.getElementById(textareaId).value = quill.root.innerHTML;
                });
            };
            makeQuill('#vision_editor', 'vision_content');
            makeQuill('#mission_editor', 'mission_content');
            makeQuill('#innovation_editor', 'innovation_content');
        });
    </script>
@endsection
