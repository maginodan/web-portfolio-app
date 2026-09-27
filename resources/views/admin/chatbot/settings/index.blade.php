@extends('layouts.admin.base')

@section('content')

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Chatbot Settings</h1>
        </div>
    </div>

    @include('includes.flash_message')

    <form
        method="POST"
        action="{{ route('admin.chatbot.settings.update') }}"
        role="form"
    >
        @csrf

        <div class="row">

            {{-- Behavior Settings --}}
            <div class="col-lg-8">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments"></i> Chatbot Behavior
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label>System Prompt</label>
                            <textarea
                                name="system_prompt"
                                class="form-control"
                                rows="8"
                                placeholder="Instructions that define how the chatbot should behave and respond"
                                required
                            >{{ old('system_prompt', $settings->system_prompt) }}</textarea>
                            {!! $errors->first('system_prompt','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label>Welcome Message</label>
                            <textarea
                                name="welcome_message"
                                class="form-control"
                                rows="3"
                                placeholder="The first message shown when a visitor opens the chat"
                            >{{ old('welcome_message', $settings->welcome_message) }}</textarea>
                            {!! $errors->first('welcome_message','<p class="text-danger">:message</p>') !!}
                        </div>

                    </div>
                </div>

                {{-- Model Parameters --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-sliders"></i> Model Parameters
                    </div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Temperature</label>
                                    <input
                                        type="number"
                                        name="temperature"
                                        step="0.1"
                                        min="0"
                                        max="2"
                                        class="form-control"
                                        value="{{ old('temperature', $settings->temperature) }}"
                                        required
                                    >
                                    <small class="text-muted">Lower is more focused/predictable, higher is more creative. 0–2.</small>
                                    {!! $errors->first('temperature','<p class="text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Max Tokens</label>
                                    <input
                                        type="number"
                                        name="max_tokens"
                                        min="1"
                                        class="form-control"
                                        value="{{ old('max_tokens', $settings->max_tokens) }}"
                                        required
                                    >
                                    <small class="text-muted">Maximum length of each chatbot response.</small>
                                    {!! $errors->first('max_tokens','<p class="text-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Provider Status --}}
                @if (isset($providers) && count($providers) > 0)
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-key"></i> Provider Status
                    </div>

                    <div class="panel-body" style="padding:0;">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" style="margin-bottom:0;">
                                <thead>
                                    <tr>
                                        <th>Provider</th>
                                        <th>Status</th>
                                        <th>Models</th>
                                        <th>API Key</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($providers as $key => $provider)
                                        <tr>
                                            <td>
                                                <strong>{{ $provider['name'] ?? ucfirst($key) }}</strong>
                                            </td>
                                            <td>
                                                @if (!empty($provider['enabled']) && !empty($provider['api_key']))
                                                    <span class="label label-success">Enabled</span>
                                                @elseif (!empty($provider['enabled']) && empty($provider['api_key']))
                                                    <span class="label label-warning">No Key</span>
                                                @else
                                                    <span class="label label-default">Disabled</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($provider['models']))
                                                    <span class="label label-info">{{ count($provider['models']) }}</span>
                                                    <span class="text-muted" style="font-size:12px;">
                                                        {{ implode(', ', array_slice(array_keys($provider['models']), 0, 2)) }}
                                                        @if (count($provider['models']) > 2)
                                                            +{{ count($provider['models']) - 2 }} more
                                                        @endif
                                                    </span>
                                                @else
                                                    <span class="text-muted">None</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($provider['api_key']))
                                                    <span class="text-success">
                                                        <i class="fa fa-check-circle"></i>
                                                        {{ substr($provider['api_key'], 0, 8) }}...{{ substr($provider['api_key'], -4) }}
                                                    </span>
                                                @else
                                                    <span class="text-danger">
                                                        <i class="fa fa-times-circle"></i> Not configured
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <small class="text-muted">
                            Configure API keys in your <code>.env</code> file or settings.
                        </small>
                    </div>
                </div>
                @endif

            </div>

            {{-- Provider & Status --}}
            <div class="col-lg-4">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plug"></i> AI Provider
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label>Preferred Provider</label>
                            <select name="preferred_provider" class="form-control" required>
                                <option value="auto" {{ old('preferred_provider', $settings->preferred_provider) === 'auto' ? 'selected' : '' }}>
                                    Auto (automatic fallback)
                                </option>
                                @foreach ($providers as $key => $provider)
                                    <option
                                        value="{{ $key }}"
                                        {{ old('preferred_provider', $settings->preferred_provider) === $key ? 'selected' : '' }}
                                        {{ !array_key_exists($key, $enabledProviders) ? 'disabled' : '' }}
                                    >
                                        {{ $provider['name'] ?? ucfirst($key) }}
                                        {{ !array_key_exists($key, $enabledProviders) ? '(not configured)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('preferred_provider','<p class="text-danger">:message</p>') !!}

                            @if (empty($enabledProviders))
                                <p class="text-danger" style="margin-top:8px;">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    No AI providers are currently configured. Add an API key in your environment settings.
                                </p>
                            @endif
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label>Status</label>

                            <div class="radio">
                                <label>
                                    <input
                                        type="radio"
                                        name="enabled"
                                        value="1"
                                        {{ old('enabled', $settings->enabled) == 1 ? 'checked' : '' }}
                                    >
                                    Enabled — chatbot is visible on the site
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input
                                        type="radio"
                                        name="enabled"
                                        value="0"
                                        {{ old('enabled', $settings->enabled) == 0 ? 'checked' : '' }}
                                    >
                                    Disabled — chatbot is hidden on the site
                                </label>
                            </div>

                            {!! $errors->first('enabled','<p class="text-danger">:message</p>') !!}
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="panel panel-default" style="margin-top:0;">
            <div class="panel-body" style="padding:12px 15px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save Settings
                </button>
            </div>
        </div>

    </form>

</div>

@endsection