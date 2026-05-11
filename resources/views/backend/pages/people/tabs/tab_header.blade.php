<div class="registration-stepper-wrapper">
    <div class="registration-stepper-container">
        <div class="stepper-scroll-container hide-scrollbar">
            <div class="stepper-inner">
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
                        ['id' => 'july_fighter', 'name' => 'July 24 Fighter', 'route' => $userId ? route('people.july_fighter', $userId) : '#', 'icon' => 'fa-fist-raised'],
                    ];
                    $current_found = false;
                @endphp

                @foreach($steps as $index => $step)
                    @php
                        $isActive    = $active_tab == $step['id'];
                        if ($isActive) $current_found = true;
                        $isCompleted = !$isActive && $current_found == false && $userId;
                    @endphp

                    <div class="step-item {{ $isActive ? 'active' : '' }} {{ $isCompleted ? 'completed' : '' }}">
                        <a href="{{ $step['route'] }}" class="step-link" onclick="{{ !$userId && !$isActive ? "event.preventDefault(); toastr.warning('Please save personal info first!');" : '' }}">
                            <div class="step-circle">
                                @if($isCompleted)
                                    <i class="fas fa-check"></i>
                                @else
                                    <i class="fas {{ $step['icon'] }}"></i>
                                @endif
                            </div>
                            <span class="step-label">{{ $step['name'] }}</span>
                        </a>
                    </div>

                    @if($index < count($steps) - 1)
                        <div class="step-line {{ $isCompleted ? 'completed' : '' }}"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .registration-stepper-wrapper {
        width: 100%;
        padding: 10px 0;
        background: transparent;
    }
    .registration-stepper-container {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        padding: 15px 20px;
        border: 1px solid #e5e7eb;
    }
    .stepper-scroll-container {
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }
    .stepper-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-width: max-content;
        padding: 5px 20px 5px 0;
    }
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    .step-item {
        flex: 0 0 auto;
        position: relative;
        z-index: 2;
    }
    .step-link {
        color: #6b7280;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none !important;
        transition: all 0.2s ease-in-out;
    }
    
    .step-circle {
        width: 38px;
        height: 38px;
        border-radius: 12px; /* Slightly rounded squares for modern look */
        background: #f3f4f6;
        border: 2px solid #e5e7eb;
        color: #9ca3af;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        transition: all 0.2s ease-in-out;
    }
    
    .step-label {
        font-size: 0.7rem;
        font-weight: 700;
        margin-top: 8px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
    }
    
    .step-item.active .step-circle {
        background: #4f46e5;
        border-color: #4f46e5;
        color: #ffffff;
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
        transform: translateY(-2px);
    }
    .step-item.active .step-label { color: #4f46e5; }
    
    .step-item.completed .step-circle {
        background: #ecfdf5;
        border-color: #10b981;
        color: #10b981;
    }
    .step-item.completed .step-label { color: #059669; }
    
    .step-line {
        flex: 0 0 auto;
        height: 2px;
        background: #e5e7eb;
        width: 45px;
        margin: 0 8px;
        margin-top: -24px;
        border-radius: 1px;
    }
    
    .step-line.completed {
        background: #10b981;
    }
    
    @media (max-width: 1400px) {
        .step-line { width: 35px; }
    }

    @media (max-width: 768px) {
        .registration-stepper-container { padding: 10px; }
        .step-circle { width: 32px; height: 32px; font-size: 0.85rem; }
        .step-label { font-size: 0.6rem; }
        .step-line { width: 20px; margin-top: -18px; }
    }
</style>

