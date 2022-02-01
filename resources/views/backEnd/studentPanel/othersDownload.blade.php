@extends('backEnd.master')

@section('title')
@lang('study.others_download')
@endsection

@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('study.others_download')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                <a href="#">@lang('study.study_material')</a>
                <a href="#">@lang('study.others_download')</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0">@lang('study.others_download')</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                    <thead>
                        @if(session()->has('message-success-delete') != "" ||
                        session()->get('message-danger-delete') != "")
                        <tr>
                            <td colspan="6">
                                @if(session()->has('message-success-delete'))
                                <div class="alert alert-success">
                                    {{ session()->get('message-success-delete') }}
                                </div>
                                @elseif(session()->has('message-danger-delete'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message-danger-delete') }}
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>@lang('study.content_title')</th>
                            <th>@lang('common.date')</th>
                            <th>@lang('study.available_for')</th>
                            <th>@lang('common.class_Sec')</th>
                            <th style="max-width:30%">@lang('common.description')</th>
                            <th>@lang('common.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($uploadContents))
                        @foreach($uploadContents as $value)
                        <tr>

                            <td>{{@$value->content_title}}</td>
                            
                            <td  data-sort="{{strtotime(@$value->upload_date)}}" >
                                {{@$value->upload_date != ""? dateConvert(@$value->upload_date):''}}

                            </td>
                            <td>
                                @if(@$value->available_for_admin == 1)
                                    @lang('study.all_admins')<br>
                                @endif
                                @if(@$value->available_for_all_classes == 1)
                                    @lang('study.all_classes_student')
                                @endif

                                @if(@$value->classes != "" && $value->sections != "")
                                    @lang('study.all_students_of') ({{@$value->classes->class_name.'->'.@$value->sections->section_name}})
                                @endif
                            </td>
                            <td>

                            @if(@$value->class != "")
                                {{@$value->classes->class_name}}
                            @endif 

                            @if(@$value->section != "")
                                ({{@$value->sections->section_name}})
                            @endif


                            </td>
                            <td>

                            {{\Illuminate\Support\Str::limit(@$value->description, 500)}}


                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        Select
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a data-modal-size="modal-lg" title="View Content Details" class="dropdown-item modalLink" href="{{route('upload-content-student-view', $value->id)}}">@lang('common.view')</a>
                                        @if(@$value->upload_file != "")
                                            @if(userPermission(34))
                                            <a class="dropdown-item" href="{{url(@$value->upload_file)}}" download>
                                                @lang('study.download') <span class="pl ti-download"></span></a>
                                            @endif
                                        @endif
                                    </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                     

                    
                            @if(isset($uploadContents2))
                            @foreach($uploadContents2 as $value2)
                           @if($value2->available_for_all_classes==0 && !empty($value2->class) && $value2->section==null)
                            <tr>
    
                                <td>{{@$value2->content_title}}</td>
                                
                                <td  data-sort="{{strtotime(@$value2->upload_date)}}" >
                                    {{@$value2->upload_date != ""? dateConvert(@$value2->upload_date):''}}
    
                                </td>
                                <td>
                                    @if(@$value2->available_for_admin == 1)
                                        @lang('study.all_admins')<br>
                                    @endif
                                    @if(@$value2->available_for_all_classes == 1)
                                        @lang('study.all_classes_student')
                                    @endif
    
                                    @if(@$value2->classes != "" && $value2->section == null)
                                        @lang('study.all_students_of') ({{@$value2->classes->class_name.'->'}} @lang('study.all_sections'))
                                    @endif
                                </td>
                                <td>
    
                                @if(@$value2->class != "")
                                    {{@$value2->classes->class_name}}
                                @endif 
    
                                @if(@$value2->section != "")
                                    ({{@$value2->sections->section_name}})
                                @endif

                                @if(@$value2->section ==null)
                                ( @lang('study.all_sections') )
                            @endif
    
    
                                </td>
                                <td>
    
                                {{\Illuminate\Support\Str::limit(@$value2->description, 500)}}
    
    
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            Select
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-modal-size="modal-lg" title="View Content Details" class="dropdown-item modalLink" href="{{route('upload-content-student-view', $value2->id)}}">@lang('common.view')</a>
                                            @if(@$value2->upload_file != "")
                                                @if(userPermission(34))
                                                <a class="dropdown-item" href="{{url(@$value2->upload_file)}}" download>
                                                    @lang('study.download') <span class="pl ti-download"></span></a>
                                                @endif
                                            @endif
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
