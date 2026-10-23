<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

abstract class ManagedResourceController extends Controller
{
    protected string $modelClass;
    protected string $routeName;
    protected string $title;

    abstract protected function fields(): array;

    abstract protected function validationRules(?int $id = null): array;

    protected function tableColumns(): array
    {
        return array_slice($this->fields(), 0, 4);
    }

    protected function prepareData(array $data, Request $request, ?Model $record = null): array
    {
        foreach ($this->fields() as $field) {
            if (($field['type'] ?? null) === 'checkbox') {
                $data[$field['name']] = $request->boolean($field['name']);
            }
        }

        return $data;
    }

    protected function afterSave(Model $record, Request $request): void
    {
    }

    public function index(): View
    {
        $records = ($this->modelClass)::query()->latest('id')->paginate(20);

        return view('admin.resources.index', [
            'title' => $this->title,
            'records' => $records,
            'columns' => $this->tableColumns(),
            'routeName' => $this->routeName,
        ]);
    }

    public function create(): View
    {
        return $this->form();
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->prepareData($request->validate($this->validationRules()), $request);
        $record = ($this->modelClass)::create($data);
        $this->afterSave($record, $request);

        return redirect()->route($this->routeName.'.index')->with('success', $this->title.' berhasil ditambahkan.');
    }

    public function edit(string $id): View
    {
        return $this->form($this->resolveRecord($id));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $record = $this->resolveRecord($id);
        $data = $this->prepareData($request->validate($this->validationRules((int) $id)), $request, $record);
        $record->update($data);
        $this->afterSave($record, $request);

        return redirect()->route($this->routeName.'.index')->with('success', $this->title.' berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->resolveRecord($id)->delete();

        return redirect()->route($this->routeName.'.index')->with('success', $this->title.' berhasil dihapus.');
    }

    private function form(?Model $record = null): View
    {
        return view('admin.resources.form', [
            'title' => $this->title,
            'record' => $record,
            'fields' => $this->fields(),
            'routeName' => $this->routeName,
        ]);
    }

    private function resolveRecord(string $key): Model
    {
        $model = new $this->modelClass();
        $routeKey = $model->getRouteKeyName();

        return $model->newQuery()
            ->where($model->getKeyName(), $key)
            ->orWhere($routeKey, $key)
            ->firstOrFail();
    }
}
