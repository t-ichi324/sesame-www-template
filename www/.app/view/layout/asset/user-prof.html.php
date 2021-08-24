<div style="text-align: center; margin-bottom: 2rem;">
    <img style="max-height: 200px;object-fit: contain;" src="<?= AsyncUploadImg::getSrcPub("img", ContentConf::DIR_USER, ContentConf::NO_AVATAR); ?>">
</div>

<table class="table user-prof">
    <tbody>
        <tr>
            <td class="lbl">{{__("prof.name")}}</td>
            <td>{{*name}}</td>
        </tr>
        <tr>
            <td class="lbl">{{__("prof.email")}}</td>
            <td><a href="mailto:{{*email}}">{{*email}}</a></td>
        </tr>
        <tr>
            <td class="lbl">{{__("prof.zipcode")}}</td>
            <td><a href="mailto:{{*zipcode}}">{{*zip_code}}</a></td>
        </tr>
        <tr>
            <td class="lbl">{{__("prof.addr")}}</td>
            <td>{{*addr1}}</td>
        </tr>
        <tr>
            <td class="lbl">{{__("prof.tel")}}</td>
            <td>{{*tel}}</td>
        </tr>
    </tbody>
</table>
