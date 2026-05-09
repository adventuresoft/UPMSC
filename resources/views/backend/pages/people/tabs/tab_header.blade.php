<div class="registration-stepper-container px-3 py-2">
    <div class="d-flex flex-nowrap overflow-auto hide-scrollbar justify-content-between align-items-center">
        @php
            $userId = optional($user)->id;
            $steps = [
                ['id' => 'personal',     'name' => 'Personal',      'route' => $userId ? route('people.edit', $userId) : '#',        'icon' => 'fa-user'],
                ['id' => 'family',       'name' => 'Family',        'route' => $userId ? route('people.family', $userId) : '#',      'icon' => 'fa-users'],
                ['id' => 'address',      'name' => 'Address',       'route' => $userId ? route('people.address', $userId) : '#',     'icon' => 'fa-map-marker-alt'],
                ['id' => 'education',    'name' => 'Education',     'route' => $userId ? route('people.education', $userId) : '#',   'icon' => 'fa-graduation-cap'],
                ['id' => 'professional', 'name' => 'Profession',    'route' => $userId ? route('people.professional', $userId) : '#','icon' => 'fa-briefcase'],
                ['id' => 'financial',    'name' => 'Financial',     'route' => $userId ? route('people.financial', $userId) : '#',   'icon' => 'fa-wallet'],
                ['id' => 'property',     'name' => 'Property',      'route' => $userId ? route('people.property', $userId) : '#',    'icon' => 'fa-building'],
                ['id' => 'disability',   'name' => 'Disability',    'route' => $userId ? route('people.disability', $userId) : '#',  'icon' => 'fa-wheelchair'],
                ['id' => 'freedom',      'name' => 'Freedom',       'route' => $userId ? route('people.freedom', $userId) : '#',     'icon' => 'fa-medal'],
            ];
            $current_found = false;
        @endphp

        @foreach($steps as $index => $step)
            @php
                $isActive    = $active_tab == $step['id'];
                if ($isActive) $current_found = true;
                $isCompleted = !$isActive && $current_found == false && $userId;
            @endphp

            <div class="step-item d-flex align-items-center flex-column mx-1 {{ $isActive ? 'active' : '' }} {{ $isCompleted ? 'completed' : '' }}">
                <a href="{{ $step['route'] }}" class="step-link text-decoration-none" onclick="{{ !$userId && !$isActive ? "event.preventDefault(); toastr.warning('Please save personal info first!');" : '' }}" title="{{ !$userId && !$isActive ? 'Save personal info first' : $step['name'] }}">
                    <div class="step-circle d-flex align-items-center justify-content-center mb-1">
                        @if($isCompleted)
                            <i class="fas fa-check"></i>
                        @else
                            <i class="fas {{ $step['icon'] }}"></i>
                        @endif
                    </div>
                    <span class="step-label text-xs font-weight-bold">{{ $step['name'] }}</span>
                </a>
            </div>

            @if($index < count($steps) - 1)
                <div class="step-line flex-grow-1 mx-2 {{ $isCompleted ? 'completed' : '' }}"></div>
            @endif
        @endforeach
    </div>
</div>

<style>
    .registration-stepper-container {
        background: #f8f9fa;
        border-radius: 12px;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
    }
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    .step-item { min-width: 70px; transition: all 0.3s ease; }
    .step-link { color: #6c757d; text-align: center; display: block; }
    
    .step-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #dee2e6;
        color: #adb5bd;
        font-size: 0.8rem;
        margin: 0 auto;
        transition: all 0.3s ease;
    }
    
    .step-label {
        font-size: 0.65rem;
        display: block;
        margin-top: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .step-item.active .step-circle {
        background: #17a2b8;
        border-color: #17a2b8;
        color: #fff;
        box-shadow: 0 0 10px rgba(23, 162, 184, 0.4);
        transform: scale(1.1);
    }
    
    .step-item.active .step-label { color: #17a2b8; }
    
    .step-item.completed .step-circle {
        background: #28a745;
        border-color: #28a745;
        color: #fff;
    }
    
    .step-item.completed .step-label { color: #28a745; }
    
    .step-line {
        height: 2px;
        background: #dee2e6;
        min-width: 20px;
        position: relative;
        top: -12px;
    }
    
    .step-line.completed { background: #28a745; }
    
    @media (max-width: 768px) {
        .step-label { display: none; }
        .step-circle { width: 28px; height: 28px; }
        .step-line { top: -4px; min-width: 10px; }
    }
</style>

