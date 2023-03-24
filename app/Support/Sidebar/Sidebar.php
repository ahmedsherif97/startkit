<?php

namespace App\Support\Sidebar;

use App\Support\Sidebar\Components\SidebarGenerator;
use App\Support\Sidebar\Components\SidebarLink;
use App\Support\Sidebar\Components\SidebarMenu;
use function route;

class Sidebar
{
    public function dashboard()
    {

        return [
            SidebarLink::to(
                t_('dashboard'),
                route('dashboard.home'),
                'las la-tachometer-alt  text-secondary',
                'line-awesome'
            ),
        ];
    }

    public function core()
    {
        $adminList = [
            SidebarLink::to(t_('admins'), route('dashboard.core.administration.admins.index')),
            SidebarLink::to(t_('roles'), route('dashboard.core.administration.roles.index')),
        ];

        return [
            SidebarMenu::create(t_('administration'), 'las la-users text-secondary', permission: '')
                ->push($adminList),
            SidebarLink::to(
                t_('Pages'),
                route('dashboard.core.pages.index'),
                'las la-file-alt text-secondary',
                'line-awesome'
            ),
            SidebarLink::to(
                t_('Home Sections'),
                route('dashboard.homesection.homesections.index'),
//                url('admin/homesection/homesections'),
                'las la-file-alt text-secondary',
                'line-awesome'
            ),
            SidebarLink::to(
                t_('Areas'),
                route('dashboard.core.areas.index'),
                'las la-globe text-secondary',
                'line-awesome'
            ),
            SidebarLink::to(
                t_('translation'),
                route('modules.translation.dashboard.index'),
                'las la-language text-secondary',
                'line-awesome'
            ),

            SidebarLink::to(
                t_('Photo Gallery'),
                route('dashboard.core.galleries.index'),
                'las la-images text-secondary',
                'line-awesome'
            ),
            SidebarLink::to(
                t_('Contacts'),
                route('dashboard.core.contacts.index'),
                'las la-phone text-secondary',
                'line-awesome'
            ),

            SidebarLink::to(
                t_('Setting'),
                route('dashboard.setting.index'),
                'las la-cogs text-secondary',
                'line-awesome'
            ),
            SidebarLink::to(
                t_('Intro'),
                route('dashboard.intro.intros.index'),
                'las la-cogs text-secondary',
                'line-awesome'
            ),


        ];
    }

    public function stores()
    {
        $storeList = [
            SidebarLink::to(t_('stores'), route('dashboard.store.stores.index')),
//            SidebarLink::to(t_('orders'), route('dashboard.store.orders.index')),
        ];
//        $mainCategories = SidebarLink::to(t_('main categories'), '', 'las la-boxes text-secondary');

//        $productList = [
//            SidebarLink::to(t_('products'), route('dashboard.store.products.index')),
//            SidebarLink::to(t_('additions'), route('dashboard.store.additions.index')),
//            SidebarLink::to(t_('categories'), route('dashboard.store.categories.index')),
//        ];
        $ticketList = [
            SidebarLink::to(t_('departments'), route('dashboard.ticket.departments.index')),
            SidebarLink::to(t_('tickets'), route('dashboard.ticket.tickets.index')),
        ];
        return [
            SidebarLink::to(
                t_('Main Categories'),
                route('dashboard.maincategory.maincategories.index'),
                'las la-cogs text-secondary',
                'line-awesome'
            ),

            SidebarMenu::create(t_('stores'), 'las la-store text-secondary', permission: '')
                ->push($storeList),
//            SidebarMenu::create(t_('products'), 'las  la-boxes text-secondary', permission: '')
//                ->push($productList),
            SidebarMenu::create(t_('departments'), 'las  la-boxes text-secondary', permission: '')
                ->push($ticketList),
        ];
    }

    public function user()
    {
        $adminList = [
            SidebarLink::to(t_('users'), route('dashboard.user.users.index')),
        ];

        return [
            SidebarMenu::create(t_('users'), 'las la-users text-secondary', permission: '')
                ->push($adminList),
        ];
    }

    public function merchantDashboard(): array
    {

        $adminList = [
            SidebarLink::to(t_('employee'), route('merchant.administration.employees.index')),
            SidebarLink::to(t_('roles'), route('merchant.administration.roles.index')),
        ];

        $productList = [
            SidebarLink::to(t_('products'), route('merchant.product.products.index')),
            SidebarLink::to(t_('categories'), route('merchant.product.categories.index')),
            SidebarLink::to(t_('additions'), route('merchant.product.additions.index')),
        ];

        $orders = [
            SidebarLink::to(t_('orders'), route('merchant.order.orders.index')),

        ];
        $couponList = [
            SidebarLink::to(t_('Coupons'), route('merchant.coupon.coupons.index'))
        ];
        $shippingList = [
            SidebarLink::to(t_('Shipping'), route('merchant.shipping.shippings.index'))
        ];
        $custom_orders = [
            SidebarLink::to(t_('Custom Orders'), route('merchant.order.customorders.index')),

        ];
        $banner = [
            SidebarLink::to(t_('bannars'), route('merchant.banner.banners.index')),

        ];
        $setting = [
            SidebarLink::to(t_('setting'), route('merchant.administration.profile')),

        ];

        $tickets = [

            SidebarLink::to(t_('tickets'), route('merchant.ticket.tickets.index')),
        ];

        return [
            SidebarLink::to(
                t_('dashboard'),
                route('merchant.home'),
                'las la-tachometer-alt  text-secondary',
                'line-awesome'
            ),
            SidebarMenu::create(t_('employee'), 'las la-users text-secondary', permission: '')
                ->push($adminList),

            SidebarMenu::create(t_('products'), 'las  la-boxes text-secondary', permission: '')
                ->push($productList),

            SidebarMenu::create(t_('coupons'), 'las  la-credit-card text-secondary', permission: '')
                ->push($couponList),

            SidebarMenu::create(t_('Shippings'), 'las  la-credit-card text-secondary', permission: '')
                ->push($shippingList),

            SidebarMenu::create(t_('orders'), 'las  la-boxes text-secondary', permission: '')
                ->push($orders),

            SidebarMenu::create(t_('Custom Orders'), 'las  la-boxes text-secondary', permission: '')
                ->push($custom_orders),

            SidebarMenu::create(t_('banner'), 'las  la-boxes text-secondary', permission: '')
                ->push($banner),

            SidebarMenu::create(t_('setting'), 'las  la-boxes text-secondary', permission: '')
                ->push($setting),

            SidebarMenu::create(t_('tickets'), 'las  la-boxes text-secondary', permission: '')
                ->push($tickets),

        ];
    }

    public function __invoke()
    {
        $generator = SidebarGenerator::create();

        if (activeGuard('dashboard')) {
            $generator->addModule(t_('dashboard'), 'icon-home', false)->push($this->dashboard());
            $generator->addModule(t_('core'), 'icon-home')->push($this->core());
            $generator->addModule(t_('users'), 'icon-home')->push($this->user());
            $generator->addModule(t_('stores'), 'icon-store')->push($this->stores());
        }

        if (activeGuard('merchant')) {
            $generator->addModule(t_('Merchant Dashboard'), 'icon-home')->push($this->merchantDashboard());
        }

        return $generator->toArray();
    }
}
